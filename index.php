<?php
require __DIR__.'/vendor/autoload.php';
header('content-type: text/plain');

use Wapkaweb\WapkaPhpSdk\API as API;

$API = new API;

var_dump($API);
