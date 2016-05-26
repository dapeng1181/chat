<?php
namespace Home\Controller;
class IndexController extends CommonController {
    function _initialize(){
        parent::_initialize();
    }
	//首页
    public function index(){
        $this->display();
    }
	//预览
	public function preview(){
		$this->url = I("get.url");
		layout(false);
		$this->display();
	}
}