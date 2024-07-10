<?php

namespace Wapkaweb\WapkaPhpSdk\User;

use Wapkaweb\WapkaPhpSdk\BaseClass;
use Wapkaweb\WapkaPhpSdk\Helper\Param;

class UserInfo extends BaseClass
{

    public function init(Param $param = null)
    {
        if ($param) {
            $this->param = $param;
        }
        if ($this->param) {
            if ($this->param->has('id')) {
                $this->db->where('id', $this->param->get('id'), "IN");
            }
            if ($this->param->has('id_not')) {
                $this->db->where('id', $this->param->get('id_not'), 'NOT IN');
            }
            //$this->db->where('siteid', $this->config->env->siteid);
            if ($this->param->has('username')) {
                $this->db->where('username', $this->param->username, "IN");
            }
        }
        return $this;
    }
    public function get(string $returnType = "array")
    {
        if ($returnType == 'object') {
            $this->db->ObjectBuilder();
        }
        return $this->db->get($this->config->tableName->userTable, $this->param->getInt('limit', 100));
    }
    public function getOne($returnType = 'array')
    {
        if ($returnType == 'object') {
            $this->db->ObjectBuilder();
        }
        return $this->db->getOne($this->config->tableName->userTable);
    }
}
