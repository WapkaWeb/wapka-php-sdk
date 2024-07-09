<?php

namespace Wapkaweb\WapkaPhpSdk;

class API
{
    public $db;
    public $config;
    public $UserInfo;

    public function __construct(Helper\Config $config = null, Object $database = null)
    {
        if ($config) {
            $this->config = $config;
        }
        if ($database) {
            $this->db = $database;
        }
    }

    public function setConfigaration(Helper\Config $config)
    {
        return $this->config = $config;
    }
    public function setDatabase(object $db)
    {
        return $this->db = $db;
    }
    public function loadClass()
    {
        $this->UserInfo = (new User\UserInfo())->setDatabase($this->db);
    }
}
