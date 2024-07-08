<?php

namespace Wapkaweb\WapkaPhpSdk\WebAPI;

use Wapkaweb\WapkaPhpSdk\API;
use Wapkaweb\WapkaPhpSdk\MysqlDB\DBClient;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
//use Slim\Factory\AppFactory;
use Slim\Exception\HttpNotFoundException;
use Slim\Exception\HttpMethodNotAllowedException;


class Client
{
    public $app;
    public function __construct($configaration = null)
    {
        $this->app = \DI\Bridge\Slim\Bridge::create();

        $this->app->get('/user', [UserController::class, 'info']);
        $this->app->get('/', function (Request $request, Response $response) {
            $response->getBody()->write("Hello world!");
            return $response;
        });
    }

    public function run()
    {
        $this->app->run();
    }
}
