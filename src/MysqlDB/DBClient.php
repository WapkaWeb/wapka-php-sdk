<?php

namespace Wapkaweb\WapkaPhpSdk\MysqlDB;

use \MysqliDb;
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
