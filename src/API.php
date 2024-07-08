<?php

namespace Wapkaweb\WapkaPhpSdk;

use Wapkaweb\WapkaPhpSdk\MysqlDB\DBClient as DB;

class API
{
    public $db;
    public $config;
    public function __construct($config = null)
    {
        if ($config) {
            $this->config = $config;
        }
    }
    public function setConfigaration(\Wapkaweb\WapkaPhpSdk\Config $config)
    {
        $this->config = $config;
    }
    public function startProcessing()
    {
        $this->db = new DB($this->config->get("database"));
    }
}
