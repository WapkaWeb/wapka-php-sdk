<?php

namespace Wapkaweb\WapkaPhpSdk\Helper;

class Session extends Config
{
    public function __construct(string $sessionID = null)
    {
        //\ini_set('session.use_cookies', 0);
        \session_id($sessionID);
        \session_start();
        $this->data = &$_SESSION;
    }
    public function __unset($name)
    {
        unset($this->data[$name]);
        unset($_SESSION[$name]);
    }
}
