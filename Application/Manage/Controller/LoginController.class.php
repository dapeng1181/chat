<?php
namespace Manage\Controller;

use Think\Controller;

class LoginController extends Controller
{
    function _initialize()
    {
        layout(false);
    }
    //登录
    public function index()
    {
        $this->isOnline();
        if (IS_POST && IS_AJAX) {
            $username = I("post.account");
            $password = I("post.password");
            $return = array();
            $User = D("User");
            if ($user = $User->checkUser($username, $password)) {
                $User->updateById($user['uid'], array("logintime"=>time(), "loginip"=>get_client_ip()));
                $_SESSION['user']['uid'] = $user['uid'];
                $_SESSION['user']['account'] = $user['account'];
                $_SESSION['user']['auth'] = $user['auth'];
                $_SESSION['user']['companyid'] = $user['companyid'];
                $return = array("status" => 1 , "info"=>"登录成功", 'url'=>U('Manage/Index/index'));
            }else{
                $return = array("status" => 0 , "info"=>"登录失败");
            }

            $this->ajaxReturn($return);
        }

        $this->display("Public:login");
    }
    //注册
    public function reg(){

        $this->isOnline();

        if(IS_POST && IS_AJAX){
            $return = array();
            $User = D("User");
            if (!$User->create()){
                $return['status'] = 0;
                $return['info'] = $User->getError();
                $this->ajaxReturn($return);
            }else{
                $User->auth = 1; //管理员权限
                $User->regtime = time();
                $account = $User->account;  //用户账号
                if($uid = $User->add()){
                    if($User->comUserReg($uid, $account)){
                        $return['status'] = 1;
                        $return['info'] = "注册成功,前去登录";
                        $return['url'] = U('Manage/Login/reg');
                        $this->ajaxReturn($return);
                    }
                }
            }
            $return['status'] = 0;
            $return['info'] = "账号注册失败";
            $this->ajaxReturn($return);
        }
        $this->display("Public:register");
    }
    //退出动作
    public function loginout(){
        session('[destroy]');
        redirect(U("Manage/Login/index"));
    }
    //验证码
    public function code(){
        $Verify = new \Think\Verify();
        $Verify->length   = 4;
        $Verify->entry();
    }

    //在线判断
    private function isOnline(){
        if (!empty($_SESSION['user']['uid'])) {
            if($_SESSION['user']['auth'] == 1){
                redirect(U("Manage/Index/index"));
            }else if($_SESSION['user']['auth'] == 2){
                redirect(U("Chat/Index/index"));
            }
        }
    }

}