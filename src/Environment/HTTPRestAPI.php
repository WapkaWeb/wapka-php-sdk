<?php

namespace Wapkaweb\WapkaPhpSdk\Environment;

use Wapkaweb\WapkaPhpSdk\API;
use Wapkaweb\WapkaPhpSdk\Helper\Param;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Factory\AppFactory;

class HTTPRestAPI extends API
{
    public $app;
    public function init()
    {
        $this->app = AppFactory::create();
        $beforeMiddleware = function (Request $request, RequestHandler $handler) {
            // Example: Check for a specific header before proceeding
            $auth = $request->getHeaderLine('Authorization');
            if (!$auth) {
                // Short-circuit and return a response immediately
                $response = $this->app->getResponseFactory()->createResponse();
                $response->getBody()->write('Unauthorized');
                return $response->withStatus(401);
            }
        
            // Proceed with the next middleware
            return $handler->handle($request);
        };
        $this->app->options('/', function (Request $request, Response $response) {
            return $response->withHeader('Access-Control-Allow-Origin', '*')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, HEAD, OPTIONS')
                ->withHeader('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept, apikey')
                ->withStatus(200);
        });
        $this->app->get('/', function (Request $request, Response $response) {
            $response->getBody()->write("Hello world!");
            return $response;
        });
        $this->app->get('/{apitoken}/{methodname}', function (Request $request, Response $response, $args) {
            $name = $args['name'];
            $response->getBody()->write("Hello, $name");
            return $response;
        });
        
        $this->app->add($beforeMiddleware);
        $this->app->run();
        return;
        // /<optional_api_token>/<method_name>
        $arr = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
        $method = strtolower($arr[1] ?? $arr[0]);
        $apiToken = count($arr) === 2 ? $arr[0] : $_SERVER['HTTP_APIKEY'] ?? $_REQUEST['apikey'] ?? "0:noapikey";
        [$siteID, $apiKey] = explode(':', $apiToken);
        if ($_SERVER['REQUEST_METHOD'] == "OPTIONS") {
        } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $param = $_GET;
            $timeToCache = 60 * 1;
            header('Cache-Control: public');
            header('Cache-Control: max-age=' . $timeToCache);
            header('Pragma: cache');
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $param = $_REQUEST;
            if (isset($_SERVER['CONTENT_TYPE']) && preg_match('/(urlencode|json|form\-data)/i', strtolower($_SERVER['CONTENT_TYPE']), $m)) {
                if ($m[1] == 'urlencode') {
                    parse_str(file_get_contents("php://input"), $input);
                } elseif ($m[1] == 'json') {
                    $input = (array) json_decode(file_get_contents("php://input"), true);
                }
                if (!empty($input) && is_array($input)) {
                    $param = array_merge($param, $input);
                }
            }
        } else {
            $this->sendResponse(['ok' => false, 'error_code' => 501, 'error_type' => 'NOT_IMPLEMENTED', 'description' => 'Not Implemented']);
        }

        ini_set('session.use_cookies', 0); # disable session cookies
        \session_id($apiKey);
        \session_start();
        $MethodName = "getSelf";
        if (!method_exists($this, $MethodName)) {
            $this->sendResponse(['ok' => false, 'error_code' => 404, 'error_type' => "NOT_FOUND", "description" => "{$method} : Not Found"]);
        } //elseif (empty($_SESSION['SITE_ID']) || ($_SESSION['SITE_ID'] != $siteID) || $siteID == 10000) { //!$db->where('siteid', $siteID)->where('id', $apiKey)->getOne('sessions')
        //$this->sendResponse(['ok' => false, 'error_code' => 401, 'error_type' => 'UNAUTHORIZED', "description" => "Provide valid API Token"]);
        //}

        $_SESSION['SITE_ID'] = $siteID;
        $userID = $_SESSION['USER_ID'] ?? 0;
        $this->setSiteID((int) $siteID);
        $this->setUserID((int) $userID);
        return $this;
    }

    public function sendResponse($response)
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, HEAD, OPTIONS, PUT, DELETE');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, apikey");
        http_response_code($response['error_code'] ?? 200);
        header('content-type: application/json; charset=utf8');
        echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit();
    }
}
