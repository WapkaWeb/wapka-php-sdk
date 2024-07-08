<?php

namespace Wapkaweb\WapkaPhpSdk\WebAPI;

class UserController
{
    private $userRepository;

    public function __construct()
    {
    }

    public function delete($request, $response)
    {
        $this->userRepository->remove($request->getAttribute('id'));

        $response->getBody()->write('User deleted');
        return $response;
    }
    public function info($request, $response)
    {
        $response->getBody()->write('I am a USER');
        var_dump(\Wapkaweb\WapkaPhpSdk\MysqlDB\DBClient::getInstance());
        return $response;
    }
}
