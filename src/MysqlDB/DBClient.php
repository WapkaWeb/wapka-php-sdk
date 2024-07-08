<?php

namespace Wapkaweb\WapkaPhpSdk\MysqlDB;

use \MysqliDb;
use \mysqli;
/*
* mysql database wrapper
*/

class DBClient extends MysqliDb
{
    public function getMe()
    {
        var_dump($this);
    }
}
