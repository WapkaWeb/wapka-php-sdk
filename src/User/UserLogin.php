<?php

namespace Wapkaweb\WapkaPhpSdk\User;

class UserLogin extends UserInfo
{

    public function validate()
    {
        $user = $this->exec();
        return $user;
    }
}
