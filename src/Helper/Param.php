<?php

namespace Wapkaweb\WapkaPhpSdk\Helper;

use Exception;
use stdClass;

class Param extends Config
{
    public function __construct($config = [])
    {
        $this->data = \array_merge((array) $this->data, (array) $config);
    }
}
