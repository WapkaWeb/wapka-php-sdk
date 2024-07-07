<?php

namespace Wapkaweb\WapkaPhpSdk;

use \MysqliDb;

$db = new MysqliDb(array(
    'host' => 'host',
    'username' => 'username',
    'password' => 'password',
    'db' => 'databaseName',
    'port' => 3306,
    'prefix' => 'my_',
    'charset' => 'utf8'
));
var_dump($db);
var_dump($db->getOne("test"));

class API
{
}
