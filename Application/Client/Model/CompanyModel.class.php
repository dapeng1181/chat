<?php
namespace Client\Model;
use Think\Model;
class CompanyModel extends Model {
    //判断客服系统标识是否存在
    public function isExist($sysid){
        if(empty($sysid)){
            return ;
        }else if(strlen($sysid) !== 32){
            return ;
        }
        $result = $this->where(array("systemid"=>$sysid))
                        ->field("companyid, company, title, style, welcome, status")
                        ->find();
        return $result;
    }
}