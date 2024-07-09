<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
header('content-type: text/plain');

$config  = new \Wapkaweb\WapkaPhpSdk\Helper\Config();
$config->setDefault();
$API = new \Wapkaweb\WapkaPhpSdk\API($config);
//$API->setConfigaration($config);
$DB = new \Wapkaweb\WapkaPhpSdk\DBClient\MysqlClient((array) $API->config->database);
$DB->setTrace(true);
$API->setDatabase($DB);
$API->loadClass();
var_dump($API->UserInfo->param(["id" => range(1, 1000)])->init());

//$app = new Wapkaweb\WapkaPhpSdk\WebAPI\Client();
//$app->run();
