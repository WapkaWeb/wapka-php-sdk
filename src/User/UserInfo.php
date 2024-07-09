<?php

namespace Wapkaweb\WapkaPhpSdk\User;

use Wapkaweb\WapkaPhpSdk\BaseClass;

class UserInfo extends BaseClass
{

    public function init()
    {
        if ($this->param) {
            foreach ($this->param as $key => $val) {
                $this->db->where($key, $val, is_array($val) ? "IN" : null );
            }
        }
        return $this->db->get('user', 20);
    }
    public function is_login()
    {
        return false;
    }
}
