<?php

namespace Wapkaweb\WapkaPhpSdk;

class BaseClass
{
    public $db;
    public $param;

    public function __construct()
    {
    }
    public function __invoke()
    {
        var_dump($this->db->get("demo"));
    }
    public function setDatabase(object $db)
    {
        $this->db = $db;
        return $this;
    }
    public function param($param = [])
    {
        $this->param = $param;
        return $this;
    }
}
