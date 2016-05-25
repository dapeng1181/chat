<?php
namespace Client\Controller;
use Think\Controller;
class IndexController extends Controller {
    //聊天窗体生成
    public function index(){
       $this->display();
    }
    //判断客服系统标识是否存在
    public function isExist(){
        $sysid = I("get.sysid");
        $result = D("Company")->isExist($sysid);
        if(is_array($result) && intval($result['status']) === 3){
            $this->ajaxReturn(array(
                "status"=>1,
                "info"=>$result
            ));
        }else{
            $this->ajaxReturn(array(
                "status"=>0,
                "info"=>"当前客服系统暂不可用"
            ));
        }

    }
    //js iframe生成
    public function kefujs(){
        $sysid = I("get.sysid");
        $result = D("Company")->isExist($sysid);
        if(!is_array($result) || intval($result['status']) !== 3){
            $this->show('window.open("'.C('OFFICIAL_WEB').'");', 'utf-8', 'text/javascript');
            exit;
        }
        $this->style = $this->themeStyle($result['style']?$result['style']:"default");
        $this->title = $result['title']?$result['title']:"在线客服";
        $this->host_url = C('ClIENT_HOST');
        $this->client_url = U('Client/Index/index',array('sysid'=>$sysid));

        //临时修改模板后缀
        C("TMPL_TEMPLATE_SUFFIX",".js");
        $content = $this->fetch("kefujs");
        $this->show($content, 'utf-8', 'text/javascript');
    }
    //访客留言
    public function message(){
        if(IS_POST && IS_AJAX){
            $data = I("post.");
            if(empty($data['phone'])||empty($data['email'])||empty($data['message'])){
                $this->ajaxReturn(array("status" => 0, "info"=>"请填写完整留言内容"));
            }
            //公司是否存在
            if(M("company")->where(array("companyid"=>$data['companyid']))->find()){
                //访客是已经记录
                if(M("visitor")->where(array("visitid"=>$data['visitid']))->find()){
                    $createtime = time();
                    //是否有过留言
                    $dialogid = M("dialog_relation")->where(array("companyid"=>$data['companyid'],"visitid"=>$data['visitid'],"cuid"=>""))->getField("id");
                    if(!$dialogid){
                        $dialogid = M("dialog_relation")->add(array(
                            "companyid"=>$data['companyid'],
                            "visitid"=>$data['visitid'],
                            "creattime"=>$createtime,
                            "neartime"=>$createtime,
                        ));
                    }
                    if($dialogid){
                        M("dialog_content")->add(array(
                            "dialogid"=>$dialogid,
                            "content"=>"手机号：".$data['phone']."；邮箱：".$data['email']."；留言：".$data['content'],
                            "type"=>"message",
                            "sendtime"=>$createtime
                        ));
                        $this->ajaxReturn(array("status" => 1, "info"=>"留言成功"));
                    }
                }
            }
            $this->ajaxReturn(array("status" => 0, "info"=>"留言失败"));
        }
        $this->ajaxReturn(array("status" => 0, "info"=>"非法操作"));
    }
    //获取聊天记录
    public function pulllist(){
        if(IS_GET && IS_AJAX){
            $data = I("get.");
            $dialogid = M("dialog_relation")->where(array("companyid"=>$data['relation'],"visitid"=>$data['visitid'],"cuid"=>$data['cuid']))->getField("id");
            $list = M("dialog_content")->where(array("dialogid"=>$dialogid))->order("sendtime asc")->select();
            $newlist = array();
            foreach($list as $key=>$value){
                $content = unserialize($value['content']);
                $content['time'] = date("m-d H:i:s",$value['sendtime']);
                $newlist[] = $content;
            }
            if(!empty($newlist)){
                $this->ajaxReturn(array("status" => 1, "info"=>$newlist));
            }
            $this->ajaxReturn(array("status" => 0, "info"=>"暂无记录"));
        }
        $this->ajaxReturn(array("status" => 0, "info"=>"非法操作"));
    }
    //主题颜色
    private function themeStyle($style = 'default'){
        switch ($style)
        {
            case 'default':
                return '#3280fc';
                break;
            case 'blue':
                return '#039BE5';
                break;
            case 'red':
                return '#d9534f';
                break;
            case 'green':
                return '#4caf50';
                break;
            case 'purple':
                return '#8666b8';
                break;
            case 'brown':
                return '#8D6E63';
                break;
            case 'yellow':
                return '#d0884d';
                break;
            case 'indigo':
                return '#3F51B5';
                break;
            case 'bluegrey':
                return '#607D8B';
                break;
            case 'black':
                return '#333';
                break;
            default:
                return '#3280fc';
        }
    }
}