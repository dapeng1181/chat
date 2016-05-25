<?php
namespace Manage\Event;

use Think\Controller;

class UserEvent extends Controller
{
    function _initialize()
    {
        $this->uid = $_SESSION['user']['uid'];
        $this->auth = $_SESSION['user']['auth'];
        $this->account = $_SESSION['user']['account'];
        $this->companyid = $_SESSION['user']['companyid'];
    }
    //测试用例
    public function test(){
        echo $this->uid;
    }

	//用户设置保存
    public function save(){
		
		if(IS_POST && IS_AJAX){
            $data = I("post.");
            $attr = $data['attr'];
            unset($data['attr']);
            $User = M("User");
            if($attr === 'account'){
                //个人信息修改
                if($User->create()){
                    $User->uid = $this->uid;
                    if(false !== $User->save()){
                        $this->ajaxReturn(array("status" => 1, "info"=>"保存成功"));
                    }else{
                        $this->ajaxReturn(array("status" => 0, "info"=>"保存失败"));
                    }
                }else{
                    $this->ajaxReturn(array("status" => 0, "info"=>$User->getError()));
                }

            }else if($attr === 'pass'){
                $data = I("post.","",false);
                //密码修改
                if(strlen($data['newpassword'])<6 || strlen($data['newpassword'])>16){
                    $this->ajaxReturn(array("status" => 0, "info"=>"newpassword:新密码长度应为6-16位"));
                }else if($data['newpassword'] !== $data['repassword']){
                    $this->ajaxReturn(array("status" => 0, "info"=>"repassword:确认密码不正确"));
                }else if(!$User->where(array("password" => md5($data['password']), "uid"=>$this->uid))->find()){
                    $this->ajaxReturn(array("status" => 0, "info"=>"password:旧密码不正确"));
                }
                if(false!==$User->save(array("uid"=>$this->uid, "password"=>md5($data['newpassword'])))){
                    $this->ajaxReturn(array("status" => 1, "info"=>"密码修改成功"));
                }else{
                    $this->ajaxReturn(array("status" => 0, "info"=>"密码修改失败"));
                }
            }else if($attr === 'company'){
                //公司信息修改
                $Company = M("Company");
                if($Company->create()){
                    if($Company->website)
                        $Company->website = str_replace("http://","",$Company->website);//删除网址前缀
                    if($Company->status)
                        $Company->status = $Company->status==1?3:4;
                    $Company->companyid = $User->getFieldByUid($this->uid, "companyid");
                    if(false !== $Company->save()){
                        $this->ajaxReturn(array("status" => 1, "info"=>"保存成功"));
                    }else{
                        $this->ajaxReturn(array("status" => 0, "info"=>"保存失败"));
                    }
                }else{
                    $this->ajaxReturn(array("status" => 0, "info"=>$User->getError()));
                }
            }
			$this->ajaxReturn(array("status" => 0, "info"=>"非法操作"));
        }
		$this->ajaxReturn(array("status" => 0, "info"=>"非法操作"));
	}

    //获取访客信息
    public function getdata(){
        if(IS_GET && IS_AJAX){
            $visitid = I("get.visitid");
            if($visitid){
                $Visitor = M("visitor");
                $data = $Visitor->where(array("visitid"=>$visitid))->field("username,mobile,address,email")->find();
                if($data){
                    $this->ajaxReturn(array("status" => 1, "info"=>$data));
                }
            }
        }
        $this->ajaxReturn(array("status" => 0, "info"=>"非法操作"));
    }
    //访客信息设置
    public function setdata(){
        if(IS_POST && IS_AJAX){
            $data = I("post.");
            $Visitor = M("visitor");
            $table_field = array("username","mobile","address","email");
            if($data['visitid'] && $data['name'] && in_array($data['name'], $table_field)){
                if(false!==$Visitor->where(array("visitid"=>$data['visitid']))->save(array($data['name']=>$data['value']))){
                    $this->ajaxReturn(array("status" => 1, "info"=>"设置成功"));
                }
            }
            $this->ajaxReturn(array("status" => 0, "info"=>"设置失败"));
        }
        $this->ajaxReturn(array("status" => 0, "info"=>"非法操作"));
    }
    
}