<?php
namespace Chat\Controller;
use Think\Controller;
class CommonController extends Controller {
    function _initialize()
    {
        $this->userEvent = A('Manage/User','Event');
        if (empty($this->userEvent->uid)) {
            redirect(U("Manage/Login/index"));
        }

    }
}