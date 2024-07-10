<?php

namespace Wapkaweb\WapkaPhpSdk\Helper;

use Exception;
use stdClass;

class Config
{
    public $data;

    public function __construct($config = [])
    {
        $this->setDefault();
        $this->data = \array_merge((array) $this->data, (array) $config);
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return (object) ($this->data[$name] ?? []);
    }

    public function __isset($name)
    {
        return isset($data[$name]);
    }
    public function __unset($name)
    {
        unset($data[$name]);
    }
    public function __toString()
    {
        return json_encode($this->data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    public function __invoke()
    {
        return (array) $this->data;
    }

    public function set($name, $value)
    {
        return $this->data[$name] = $value;
    }
    public function get($name, $default = null)
    {
        return $this->data[$name] ?? $default;
    }

    public function getInt($name, int $default = 0)
    {
        return isset($this->data[$name]) && is_numeric($this->data[$name]) ? (int) $this->data[$name] : $default;
    }
    public function has($name)
    {
        return isset($this->data[$name]);
    }
    public function getAll()
    {
        return (array) $this->data;
    }

    public function __call($name, $arguments)
    {
        if (isset($this->data[$name])) {
            return (object) $this->data[$name];
        }
        throw new Exception(__CLASS__ . ": {$name} not found!");
    }

    private function setDefault()
    {
        $this->set('database', [
            'host' => '45.149.206.232',
            'username' => 'robot',
            'password' => 'ilYCAuphPz3CFBj',
            'db' => 'wapka_test_db',
            'port' => 3306,
            'charset' => 'utf8mb4'
        ]);
        $this->set('tableName', [
            'userTable' => 'user',
            'siteTable' => 'site',
            'codeTable' => 'code',
            'countryTable' => 'country',
            'dataTable' => 'data',
        ]);
    }
}
