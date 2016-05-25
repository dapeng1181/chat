<?php
namespace Manage\Controller;
class SettingController extends CommonController
{

    function  _initialize()
    {
        parent::_initialize();
    }
    //基本设置
    public function index()
    {
        $userinfo = D("User")->getInfoById($this->userEvent->uid);
        $companyinfo = M("Company")->find($this->userEvent->companyid);
        $this->assign("user", $userinfo);
        $this->assign("company", $companyinfo);
        $this->display();
    }
    //网站接入
    public function pc(){
        $companyinfo = M("Company")->find($this->userEvent->companyid);
        $this->company = $companyinfo;
        $this->js_url = U('Client/Index/kefujs@'.C('OFFICIAL_WEBSITE'),array("sysid"=>$companyinfo['systemid']));
        $this->http_url = U('Client/Index/index@'.C('OFFICIAL_WEBSITE'),array("sysid"=>$companyinfo['systemid']));
        $this->display();
    }
    //保存设置
    public function save()
    {
        $this->userEvent->save();
    }

}