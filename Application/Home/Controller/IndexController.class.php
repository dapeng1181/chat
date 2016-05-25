<?php
namespace Home\Controller;
class IndexController extends CommonController {
    function _initialize(){
        parent::_initialize();
    }
    public function index(){
        $this->display();
    }
}