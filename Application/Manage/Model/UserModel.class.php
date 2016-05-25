<?php
namespace Manage\Model;

class UserModel extends CommonModel
{
    protected $tableName = 'user';
    protected $_validate = array(
        //新增时自动验证
        array('account','require','account:用户账号不能为空',self::MUST_VALIDATE,'',self::MODEL_INSERT),
        array('account','','account:帐号名称已经存在',self::MUST_VALIDATE,'unique',self::MODEL_INSERT),
        //array('account','accountEmail','account:帐号名称已经存在',self::MUST_VALIDATE,'callback',self::MODEL_BOTH),
        array('password','6,16','password:密码长度不合法',self::MUST_VALIDATE,'length',self::MODEL_INSERT),
        //管理员修改密码时
        array('password','6,16','password:密码长度不合法',self::VALUE_VALIDATE,'length',self::MODEL_UPDATE),

        array('code','checkCode','code:验证码错误',self::EXISTS_VALIDATE,'function',self::MODEL_BOTH)
    );
    protected $_auto = array (
        //新增时自动完成
        array('status','3',self::MODEL_INSERT,'string'),
        array('password','md5',self::MODEL_INSERT,'function'),
        array('email','account',self::MODEL_INSERT,'field'),
        array('auth','2',self::MODEL_INSERT,'string'),
        array('regtime','time',self::MODEL_INSERT,'function'),
        array('regip','get_client_ip',self::MODEL_INSERT,'function')
    );

    public function checkUser($username, $password)
    {
        $user = $this->where(
            array(
                "account" => $username,
                "password" => md5($password),
                "status" => 3
            )
        )->find();
        if (!empty($user)) {
            return $user;
        }

        return array();
    }

    public function getCompanyid($id)
    {
        $rs = $this->getInfoById($id);

        return $rs['companyid'];
    }
    /**
     * 完成公司注册
     * @param $uid
     * @param $account
     */
    public function comUserReg($uid, $account){
        if(!empty($uid) && !empty($account)){
            $Mcompany = M("company");
            $data = array();
            $data['seatnum'] = 2; //客服坐席
            $data['receptnum'] = 10;//席位最大接待量
            $data['status'] = 3;  //公司状态
            if($companyid = $Mcompany->data($data)->add()){
                $this->save(array('uid'=>$uid, 'companyid'=>$companyid));
                $systemid = md5($companyid."sys".$account); //公司客服系统唯一标识
                $Mcompany->save(array('companyid'=>$companyid, 'systemid'=>$systemid));
                return true;
            }
        }
        $this->delete($uid);
        return false;
    }
    /**
     *账号唯一性检查
     *暂时不用 账号检查唯一性，邮箱不检查唯一性
     */
    public function accountEmail($account){
        if(empty($account))
            return false;
        if($this->where(array("email"=>$account))->find())
            return false;
        return true;
    }
}