<?php
require __DIR__ . '/vendor/autoload.php';
header('content-type: text/plain');

//use Wapkaweb\WapkaPhpSdk\API as API;
use Wapkaweb\WapkaPhpSdk\MysqlDB;
use Wapkaweb\WapkaPhpSdk\MysqlDB\DBClient;

$db = new DBClient(array(
    'host' => '45.149.206.232',
    'username' => 'robot',
    'password' => 'ilYCAuphPz3CFBj',
    'db' => 'wapka_db',
    'port' => 3306,
    'charset' => 'utf8mb4'
));

var_dump(class_exists("mysqli"));
var_dump($db->getOne("test"));

var_dump(new DBClient());

//$API = new API;

//var_dump($API);
