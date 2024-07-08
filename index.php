<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
header('content-type: text/plain');

$API = new Wapkaweb\WapkaPhpSdk\API();
$config  = new \Wapkaweb\WapkaPhpSdk\Config();
$config->set('database', [
    'host' => '45.149.206.232',
    'username' => 'robot',
    'password' => 'ilYCAuphPz3CFBj',
    'db' => 'wapka_test_db',
    'port' => 3306,
    'charset' => 'utf8mb4'
]);

$API->setConfigaration($config);
$API->startProcessing();
var_dump($API->config->get("database"));
var_dump($API->db->get("demo"));

//$app = new Wapkaweb\WapkaPhpSdk\WebAPI\Client();
//$app->run();
