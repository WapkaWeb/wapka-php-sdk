<?php

namespace Wapkaweb\WapkaPhpSdk;

class BaseClass
{
    public $config;
    public $db;
    public $param;

    public function __construct(Helper\Config $config = null, DBClient\MysqlClient | Helper\Config $db = null, Helper\Param $param = null)
    {
        if ($config) {
            $this->config = $config;
        }
        if ($db) {
            $this->db = $db;
        }
        if ($param) {
            $this->param = $param;
        }
    }
    public function __invoke()
    {
    }
    public function setConfiguration(Helper\Config $config)
    {
        return $this->config = $config;
    }

    public function setDatabase(DBClient\MysqlClient | Helper\Config $db)
    {
        $this->db = $db;
        return $this;
    }
    public function setParam(Helper\Param $param)
    {
        $this->param = $param;
        return $this;
    }
}
