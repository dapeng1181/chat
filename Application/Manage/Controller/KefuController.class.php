<?php
namespace Manage\Controller;
class KefuController extends CommonController
{

    public function index()
    {
        $User = M("User");
        $map = array(
            "companyid" => $this->userEvent->companyid,
            "auth" => 2
        );
        $count      = $User->where($map)->count();
        $page       = new \Think\Page($count,20);
        $list = $User->where($map)
            ->order("regtime desc")
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        $page->setConfig('prev', "上一页");
        $page->setConfig('next', "下一页");
        $page->setConfig('theme', "%UP_PAGE% %DOWN_PAGE%");
        $show = $page->show();
        $this->assign("list", $list);
        $this->assign('page',$show);
        $this->display();
    }

    //编辑客服
    public function edit()
    {
        layout(false);
        $uid = I("get.uid");
        if($uid){
            $user = M("user")->find($uid);
            if($user)
                $this->assign("userinfo", $user);
        }
        $this->display();
    }
    //新增客服
    public function doedit()
    {
        if(IS_POST && IS_AJAX){
            $return = array();
            $User = D("User");
            if (!$User->create()){
                $return['status'] = 0;
                $return['info'] = $User->getError();
                $this->ajaxReturn($return);
            }else{
                if($User->uid){
                    if($User->password){
                        $User->password = md5($User->password);
                    }else{
                        unset($User->password);
                    }
                    if(false !== $User->save()){
                        $return['status'] = 1;
                        $return['info'] = "客服编辑成功";
                        $this->ajaxReturn($return);
                    }
                }else{
                    $User->auth = 2; //客服权限
                    $User->regtime = time();
                    $User->companyid = $this->userEvent->companyid;
                    if($User->add()){
                        $return['status'] = 1;
                        $return['info'] = "客服新增成功";
                        $this->ajaxReturn($return);
                    }
                }
            }
            $return['status'] = 0;
            $return['info'] = $User->getError();
            $this->ajaxReturn($return);
        }
    }
}