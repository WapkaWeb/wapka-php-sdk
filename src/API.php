<?php

namespace Wapkaweb\WapkaPhpSdk;

class API
{
    public $session;
    public $config;
    public $db;
    public $param;
    public $siteID;
    public $userID;
    public $ActiveUserInfo;
    public $UserCreator;
    public $UserEdit;
    public $UserInfo;
    public $UserLogin;

    public function __construct(Helper\Session $session = null, Helper\Config $config = null, DBClient\MysqlClient $db = null, Helper\Param $param = null)
    {
        if ($session) {
            $this->session = $session;
        }
        if ($config) {
            $this->config = $config;
        }
        if ($db) {
            $this->db = $db;
        }
        if ($param) {
            $this->param = $param;
        }
        \date_default_timezone_set('UTC');
    }

    public function setConfiguration(Helper\Config $config)
    {
        return $this->config = $config;
    }
    public function setDatabase(object $db)
    {
        return $this->db = $db;
    }
    public function setSiteID(int $siteID)
    {
        $this->siteID = $siteID;
    }

    public function getSelf()
    {
        if ($this->ActiveUserInfo) {
            return $this->ActiveUserInfo;
        }
        if (!$this->userID) {
            return [];
        }
        $param = new helper\Param([['siteid' => $this->siteID, 'userid' => $this->userID]]);
        return $this->ActiveUserInfo = $this->UserInfo->setParam($param)->getOne();
    }

    public function setUserID(int $userID)
    {
        $this->userID = $userID;
    }

    public function loadClass()
    {
        $this->UserInfo = new User\UserInfo();
        $this->UserInfo->setConfiguration($this->config);
        $this->UserInfo->setDatabase($this->db);
        $this->UserLogin = new User\UserLogin($this->config, $this->db, $this->param);
    }
}
