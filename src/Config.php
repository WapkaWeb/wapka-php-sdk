<?php

namespace Wapkaweb\WapkaPhpSdk;

class Config
{
    public $data;

    public function __construct($config = [])
    {
        $this->data = \array_merge((array) $this->data, (array) $config);
    }

    public function getConfig()
    {
        return (array) $this->data;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }
    public function __call($name, $arguments)
    {
        if (isset($this->data[$name])) {
            return $this->data[$name];
        }
    }
    public static function __callStatic($name, $arguments)
    {
        return self::$data[$name];
    }
    public function set($name, $value)
    {
        $this->data[$name] = $value;
    }
    public function get($name)
    {
        $this->data[$name] ?? null;
    }
}
