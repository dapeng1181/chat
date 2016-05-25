<?php
namespace Manage\Model;

class CommonModel extends \Think\Model
{

    public function getInfoById($id)
    {
        $pk = $this->getPk();

        $info = $this->where(array($pk => $id))->find();
        if (!empty($info)) {
            return $info;
        }

        return array();
    }

    public function addData($data)
    {
        if ($this->create($data)) {
            if ($this->add()) {
                return $this->getLastInsID();
            }
        }

        return false;
    }

    public function getDbError()
    {
        return $this->getError();
    }

    public function updateById($id, $data)
    {
        $pk = $this->getPk();

        $rs = $this->where(array($pk => $id))->save($data);
        if ($rs) {
            return true;
        }

        return false;
    }

    public function getListByWhere($where = array())
    {
        $list = $this->where($where)->select();
        if (empty($list)) {
            $list = array();
        }

        return $list;
    }
}