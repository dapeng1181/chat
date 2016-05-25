<?php
namespace Manage\Controller;
use Think\Controller;
class RegisterController extends Controller {
	function _initialize()
    {
		layout(false);
    }
	public function index(){
		$this->display("Public:register");
	}
}