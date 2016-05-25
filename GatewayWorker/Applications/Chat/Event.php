<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;
use \GatewayWorker\Lib\Db;
/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Event
{
	/**
     * 当客户端连接时触发
     * 如果业务不需此回调可以删除onConnect
     * 
     * @param int $client_id 连接id
     */
    public static function onConnect($client_id)
    {
    }
    
   /**
    * 当客户端发来消息时触发
    * @param int $client_id 连接id
    * @param mixed $message 具体消息
    */
   public static function onMessage($client_id, $message)
   {
       //当前时间
       $nowTime = time();
	   if( !!trim($message) ) {
		   $message = json_decode($message, true);
		   //安全过滤
		   if (is_array($message) && !empty($message)) {
			   foreach ($message as $key => $value) {
				   $message[$key] = trim(strip_tags($value));
			   }
		   }
           extract($message);
           //事件处理
           //访客信息处理
           $Db = Db::instance('db');
           if($role === 'visitor'){
               if($type === 'login') {
                   //登录事件{"type":"login", "uid":"访客标识", "role":"角色", "relation":"所属系统"，"app":"终端"}
                   $uid = empty($uid) ? md5($client_id.microtime(true)) : $uid;
                   $_SESSION['uid'] = $uid; //个人标识
                   $_SESSION['role'] = $role; //角色
                   $_SESSION['ip'] = $_SERVER['REMOTE_ADDR']; //访客的ip信息
                   $_SESSION['relation'] = $relation; //所属关系companyid
                   $_SESSION['state'] = "wait"; //排队状态
                   $_SESSION['group'] = ""; //访客或客服所属群组
                   $_SESSION['app'] = $app; //登录终端

                   Gateway::bindUid($client_id, $uid);//$uid绑定
                   Gateway::joinGroup($client_id, "wait_" . $relation);//当前客服系统排队状态组
                   //检测访客是否已经存在
                   if(!$Db->select('id')->from('we_visitor')->where("visitid= '{$uid}'")->single()){
                       $Db->insert('we_visitor')->cols(array('visitid'=>"{$uid}", 'ip'=>"{$_SESSION['ip']}"))->query();
                   }
                   //访客刷新页面的情况处理,查看链接的客服是否还在线,并且客服量是否超过10个
                   //注意要判断是重新加载页面还是又另外打开一个页面
                   $kefNoUse = false; //当前客服是否可再分配标识
                   if (isset($group)) {
                       $kfClientList = Gateway::getClientIdByUid($group);
                       $kfIsOnline = false; //客服是否在线
                       if (!empty($kfClientList) && Gateway::isOnline($kfClientList[0])) {
                           $kfIsOnline = true;
                       }
                       if ($kfIsOnline) {
                           $clientList = Gateway::getClientInfoByGroup($group);
                           if ($clientList) {
                               $s_c_g = array();
                               foreach ($clientList as $k => $v) {
                                   $s_c_g[$v['uid']] = $k;
                               }
                               $s_c_g_l = count($s_c_g); //当前客服的接待量

                               //客服接待量<10 或 >=10并且相应的访客uid已存在
                               if (($s_c_g_l < 10) ||($s_c_g_l>=10 && isset($s_c_g[$uid]))) {
                                   $kefNoUse = true;
                               }
                           }
                       }
                   }
                   //如果当前客服可分配
                   if ($kefNoUse) {
                       $_SESSION['group'] = $group;//指定客服
                       Gateway::joinGroup($client_id, $group);
                       Gateway::leaveGroup($client_id, "wait_" . $relation);//会话状态转移
                       Gateway::joinGroup($client_id, "chat_" . $relation);

                       //发信息给访客
                       $msg = array();
                       $msg['type'] = 'chat'; //有客服接待事件
                       $msg['uid'] = $_SESSION['uid'];
                       $msg['group'] = $group;
                       $msg['groupname'] = $Db->select('nickname')->from('we_user')->where("uid= '{$group}'")->single();
                       Gateway::sendToUid($_SESSION['uid'], json_encode($msg));

                       unset($msg);
                       //发信息给当前客服
                       $msg = array();
                       $msg['type'] = 'visitor'; //访客的信息 用于更新访客列表
                       $msg['ip'] = $_SERVER['REMOTE_ADDR']; //访客的ip信息
                       $msg['app'] = $app;//访客终端类型
                       $msg['clientUid'] = $_SESSION['uid']; //访客的标识uid
                       Gateway::sendToUid($group, json_encode($msg));
                       unset($msg);
                   } else {
                       $kefuNum = Gateway::getClientCountByGroup("kf_".$relation);//获取当前客服系统客服在线数量
                       if ($kefuNum > 0) {
                           //原则:平均分配访客给客服
                           $kefuList = Gateway::getClientInfoByGroup("kf_".$relation);//获取当前客服系统的客服信息
                           $c_n = array();//'客服id'=>'接待量'
                           foreach ($kefuList as $key => $value) {
                               $c_n[$value['uid']] = 0;
                               $clientList = Gateway::getClientInfoByGroup($value['uid']);//客服接待列表
                               if ($clientList) {
                                   $s_c = array();
                                   foreach ($clientList as $k => $v) {
                                       $s_c[$v['uid']] = $k;
                                   }
                                   $c_n[$value['uid']] = count($s_c);
                               }
                           }
                           asort($c_n);
                           reset($c_n);
                           $c_n_uid = key($c_n);//获取接待量最小的客服uid
                           $c_n_num = current($c_n); //获取接待量最小的客服的接待数量
                           if ($c_n_num < 10) {
                               $_SESSION['group'] = $c_n_uid;//指定客服
                               Gateway::joinGroup($client_id, $c_n_uid);
                               //访客会话状态转移
                               Gateway::leaveGroup($client_id, "wait_" . $relation);
                               Gateway::joinGroup($client_id, "chat_" . $relation);
                               //客服会话状态转移
                               $c_n_client_ids = Gateway::getClientIdByUid($c_n_uid);
                               foreach($c_n_client_ids as $value){
                                   Gateway::leaveGroup($value, "free_" . $relation);
                                   Gateway::joinGroup($value, "busy_" . $relation);
                               }
                               //发消息给管理员页面，告知当前的会话状态
                               //....

                               //发信息给访客
                               $msg = array();
                               $msg['type'] = 'chat'; //有客服接待事件
                               $msg['uid'] = $_SESSION['uid'];
                               $msg['group'] = $c_n_uid;
                               $msg['groupname'] = $Db->select('nickname')->from('we_user')->where("uid= '{$c_n_uid}'")->single();
                               //$msg['groupname'] = "客服名称"; //客服昵称
                               Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                               unset($msg);
                               //发信息给当前客服
                               $msg = array();
                               $msg['type'] = 'visitor'; //访客的信息 用于更新访客列表
                               $msg['ip'] = $_SERVER['REMOTE_ADDR']; //访客的ip信息
                               $msg['app'] = $app;//访客终端类型
                               $msg['clientUid'] = $_SESSION['uid']; //访客的标识uid
                               Gateway::sendToUid($c_n_uid, json_encode($msg));
                               unset($msg);
                               //--聊天关系入库
                               $chat_dialogid = $Db->select('id')->from('we_dialog_relation')->where("visitid='{$uid}' and companyid='{$relation}'and cuid='{$c_n_uid}'")->single();
                               if(!$chat_dialogid){
                                   $chat_dialogid = $Db->insert('we_dialog_relation')->cols(array('visitid'=>"{$uid}",'companyid'=>"{$relation}",'cuid'=>"{$c_n_uid}",'creattime'=>"{$nowTime}",'neartime'=>"{$nowTime}"))->query();
                               }
                               //array("type"=>"chat") //聊天开始标识
                               if($chat_dialogid){
                                   $chat_content = serialize(array("type"=>"chat"));
                                   $Db->insert('we_dialog_content')->cols(array('dialogid'=>"{$chat_dialogid}",'content'=>"{$chat_content}",'sendtime'=>"{$nowTime}"))->query();
                               }
                               //--入库结束
                           } else {
                               //超出规定接待量时，不允许再接待，当前访客处于排队中
                               $msg = array();
                               $msg['type'] = 'wait';//没有分配客服，排队中
                               $msg['uid'] = $_SESSION['uid'];
                               Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                               unset($msg);
                           }
                           unset($c_n, $s_c);
                       } else {
                           //没有客服在线
                           $msg = array();
                           $msg['type'] = 'message'; //无客服，跳转到留言页面
                           $msg['uid'] = $_SESSION['uid'];
                           Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                           unset($msg);
                       }
                   }

               }else if($type === 'text'){
                   //发送信息
                   $msg = array();
                   $msg['type'] = 'text';
                   $msg['content'] = $content;
                   $msg['from'] = $_SESSION['uid'];
                   $msg["time"] = date("h:i:s", $nowTime);
                   //发给访客
                   Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                   //发给客服
                   $msg['visitid'] = $_SESSION['uid'];
                   Gateway::sendToUid($to, json_encode($msg));
                   unset($msg);
                   //--聊天内容入库
                   $chat_dialogid = $Db->select('id')->from('we_dialog_relation')->where("visitid='{$_SESSION['uid']}' and companyid='{$_SESSION['relation']}' and cuid='{$to}'")->single();
                   if(!$chat_dialogid){
                       $chat_dialogid = $Db->insert('we_dialog_relation')->cols(array('visitid'=>"{$_SESSION['uid']}",'companyid'=>"{$_SESSION['relation']}",'cuid'=>"{$to}",'creattime'=>"{$nowTime}",'neartime'=>"{$nowTime}"))->query();
                   }
                   if($chat_dialogid){
                       $Db->update('we_dialog_relation')->cols(array('neartime'=>"{$nowTime}"))->where("id='{$chat_dialogid}'")->query();
                       $chat_content = serialize(array("type"=>"text","content"=>$content,"from"=>$_SESSION['uid'],"to"=>$to));
                       $Db->insert('we_dialog_content')->cols(array('dialogid'=>"{$chat_dialogid}",'content'=>"{$chat_content}",'sendtime'=>"{$nowTime}"))->query();
                   }
                   //--入库结束
               }
           }else if($role === 'worker'){
               if($type === 'login') {
                  // {"type":"login", "uid":"客服标识", "role":"角色", "relation":"所属系统"}
                   $_SESSION['uid'] = $uid; //个人标识
                   $_SESSION['role'] = $role; //角色
                   $_SESSION['relation'] = $relation; //所属系统关系companyid
                   $_SESSION['state'] = "free"; //空闲状态

                   Gateway::bindUid($client_id, $uid);//$uid绑定
                   Gateway::joinGroup($client_id, "kf_".$relation);//在线客服组

                   //刷新操作 查看当前客服对应的聊天组是否有人
                   if(Gateway::getClientCountByGroup($uid)){
                       Gateway::joinGroup($client_id, "busy_" . $relation);//忙碌状态组
                       $client_id_s = Gateway::getClientInfoByGroup($uid);//获取在线访客列表
                       $client_uid_s = array(); //
                       foreach($client_id_s as $value){
                           if(!isset($client_uid_s[$value['uid']])){
                               $client_uid_s[$value['uid']] = array(
                                   "ip"=> $value["ip"],
                                   "app"=>$value["app"],
                               );
                           }
                       }
                       $msg = array();
                       $msg['type'] = 'load';
                       $msg['list'] = $client_uid_s;
                       Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                       unset($msg);
                   }else{
                       Gateway::joinGroup($client_id, "free_" . $relation);//空闲状态组
                   }
               }else if($type === 'close'){
                   //结束当前会话
                   $msg = array();
                   $msg['type'] = 'close';
                   //发给访客 访客端直接ws.close();
                   Gateway::sendToUid($visitid, json_encode($msg));
                   unset($msg);
               }else if($type === 'text'){
                   //发送信息
                   $msg = array();
                   $msg['type'] = 'text';
                   $msg['content'] = $content;
                   $msg['from'] = $_SESSION['uid'];
                   $msg["time"] = date("h:i:s", $nowTime);
                   //发给访客
                   Gateway::sendToUid($to, json_encode($msg));
                   //发给客服
                   $msg['visitid'] = $to;
                   Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                   unset($msg);
                   //--聊天内容入库
                   $chat_dialogid = $Db->select('id')->from('we_dialog_relation')->where("visitid='{$to}' and companyid='{$_SESSION['relation']}' and cuid='{$_SESSION['uid']}'")->single();
                   if(!$chat_dialogid){
                       $chat_dialogid = $Db->insert('we_dialog_relation')->cols(array('visitid'=>"$to",'companyid'=>"{$_SESSION['relation']}",'cuid'=>"{$_SESSION['uid']}",'creattime'=>"{$nowTime}",'neartime'=>"{$nowTime}"))->query();
                   }
                   if($chat_dialogid){
                       $Db->update('we_dialog_relation')->cols(array('neartime'=>"{$nowTime}"))->where("id='{$chat_dialogid}'")->query();
                       $chat_content = serialize(array("type"=>"text","content"=>$content,"from"=>$_SESSION['uid'],"to"=>$to));
                       $Db->insert('we_dialog_content')->cols(array('dialogid'=>"{$chat_dialogid}",'content'=>"{$chat_content}",'sendtime'=>"{$nowTime}"))->query();
                   }
                   //--入库结束
               }
           }else if($role === 'admin'){
               if($type === 'login') {
                   $_SESSION['uid'] = $uid; //个人标识
                   $_SESSION['role'] = $role; //角色
                   $_SESSION['relation'] = $relation;
                   Gateway::bindUid($client_id, $uid);//$uid绑定

                   //获取在线客服
                   $online_s['kf_online_s'] = Gateway::getClientInfoByGroup("kf_".$relation);//获取在线访客列表
                   $online_s['client_wait_online_s'] = Gateway::getClientInfoByGroup("wait_".$relation);//获取在线访客等待列表
                   $online_s['client_chat_online_s'] = Gateway::getClientInfoByGroup("chat_".$relation);//获取在线访客咨询列表
                   $online_uid_s = array();
                   $online_uid_num = array(
                       'kf_online_s'=>0,
                       'client_wait_online_s'=>0,
                       'client_chat_online_s'=>0
                   );

                   foreach($online_s as $key=>$value){
                       foreach($value as $v){
                           if(!isset($online_uid_s[$key][$v['uid']])){
                               $online_uid_s[$key][$v['uid']] = $value;
                               $online_uid_num[$key]++;
                           }
                       }
                   }
                   $msg = array();
                   $msg['type'] = 'onlineNum';
                   $msg['list'] = $online_uid_num;
                   Gateway::sendToUid($_SESSION['uid'], json_encode($msg));
                   unset($msg);
               }
           }


	   }

	   /*
	    $data = array("type"=>"talk","content"=>$message,"id"=>"c");
		
		Gateway::sendToClient($client_id, json_encode($data));
		
		//连接图灵智能机器人
		$info = file_get_contents("http://www.tuling123.com/openapi/api?key=77b25f16db0d855a702af14be602d641&info=".$message);
		$info = json_decode($info, true);
		$data = array("type"=>"talk","content"=>$info['text'],"id"=>"s");
		
        Gateway::sendToClient($client_id, json_encode($data));
	   */
	   
   }
   
   /**
    * 当用户断开连接时触发
    * @param int $client_id 连接id
    */
   public static function onClose($client_id)
   {
        //如果访客已经退出 通知客服
       if($_SESSION['role'] === 'visitor'){
           if(!count(Gateway::getClientIdByUid($_SESSION['uid']))){
               $msg = array();
               $msg['type'] = 'visitorExit'; //访客的信息 用于更新访客列表
               $msg['clientUid'] = $_SESSION['uid']; //访客的标识uid
               Gateway::sendToUid($_SESSION['group'], json_encode($msg));
               unset($msg);
           }
       }

   }

}
