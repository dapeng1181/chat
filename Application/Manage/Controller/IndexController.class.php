<?php
namespace Manage\Controller;
class IndexController extends CommonController {
	function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        $this->display();
    }

    //获取访客信息
    public function getdata(){
        $this->userEvent->getdata();
    }
    //保存访客信息
    public function setdata(){
        $this->userEvent->setdata();
    }
}