<?php
namespace Chat\Controller;
class HistoryController extends CommonController {
	function _initialize()
    {
        parent::_initialize();
    }
    public function index(){
        //获取历史会话消息
        $Dialog_relation = M("dialog_relation");
        $Visitor = M("visitor");
        $map = array(
            "cuid"=>$this->userEvent->uid,
            );
        $count      = $Dialog_relation->where($map)->count();
        $page       = new \Think\Page($count,20);
        $list = $Dialog_relation->where($map)
            ->order("neartime desc")
            ->limit($page->firstRow.','.$page->listRows)
            ->select();
        foreach($list as $key=>$value){
            $username = $Visitor->getFieldByVisitid($value['visitid'],"username");
            $list[$key]['username'] = $username?$username:"Guest_".substr($value['visitid'],-8);
            $list[$key]['neartime'] = date("Y-m-d H:i:s",$value['neartime']);
        }
        $page->setConfig('prev', "上一页");
        $page->setConfig('next', "下一页");
        $page->setConfig('theme', "%UP_PAGE% %DOWN_PAGE%");
        $show = $page->show();
        $this->assign("list", $list);
        $this->assign('page',$show);
        $this->display();
    }
}