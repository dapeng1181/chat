<?php
namespace Chat\Controller;
class SettingController extends CommonController {
    public function index(){
        $userinfo = D("Manage/User")->getInfoById($this->userEvent->uid);
        $this->assign("user", $userinfo);
        $this->display();
    }
    //保存设置
    public function save()
    {
        $this->userEvent->save();
    }
}