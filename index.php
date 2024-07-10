<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
header('content-type: text/plain');

$session = new \Wapkaweb\WapkaPhpSdk\Helper\Session(md5("test"));
$config  = new \Wapkaweb\WapkaPhpSdk\Helper\Config();
$db = new \Wapkaweb\WapkaPhpSdk\DBClient\MysqlClient($config->get("database"));
$db->setTrace(true);
$API = new \Wapkaweb\WapkaPhpSdk\Environment\HTTPRestAPI($session, $config, $db);
$API->loadClass();
//$param = new \Wapkaweb\WapkaPhpSdk\Helper\Param(["id" => range(1, 10), 'limit' => 10]);
var_dump($API->init());
unset($session->test);
//$app = new Wapkaweb\WapkaPhpSdk\WebAPI\Client();
//$app->run();
var_dump(session_id());
