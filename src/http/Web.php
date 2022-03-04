<?php

namespace Yuri\Slim\http;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Yuri\Slim\app\App;
use Yuri\Slim\helper\Jwt;
use Yuri\Slim\model\QueryResponse;
use Yuri\Slim\model\users\dto\AccountsDto;
use Yuri\Slim\model\users\dto\LoginDto;
use Yuri\Slim\service\database\CreateTableService;
use Yuri\Slim\service\login\LoginService;
use Yuri\Slim\service\register\RegisterService;
use Yuri\Slim\service\session\SessionService;

class Web extends App
{
    public function __construct()
    {
        parent::__construct("", true);

        // this is used in every endpoints that needs sessions
        App::$mainApp->get(
            '/api/session/verify',
            function (Request $request, Response $response, $args) {
                $queryResponse = new QueryResponse();
                try {
                    $param = $request->getParsedBody();
                    $tokenArray = Jwt::parseToken($param->token);

                    $queryResponse->message = array(
                        'token_array' => $tokenArray,
                        'verify' => SessionService::verify($param->token)
                    );
                } catch (Exception $e) {
                    $queryResponse->code = QUERY_STATUS['failed'];
                    $queryResponse->message = $e->getMessage();
                }
                $response->getBody()->write(json_encode(
                    $queryResponse->jsonSerialize()
                ));
                return $response;
            }
        );

        // --------------------------------------------------------------------------------
        App::$mainApp->post(
            '/api/v/{version}/register/account',
            function (Request $request, Response $response, $args) {
                $params = new AccountsDto($request);
                $result = RegisterService::accounts($params);
                $response->getBody()->write($result);
                return $response;
            }
        );

        App::$mainApp->post(
            '/api/v/{version}/login/attempt',
            function (Request $request, Response $response, $args) {
                $params = new LoginDto($request);
                $result = LoginService::attempt($params);
                $response->getBody()->write($result);
                return $response;
            }
        );

        App::$mainApp->get(
            '/db/create/table/users',
            function (Request $request, Response $response, $args) {
                $result = CreateTableService::createUsersTable();
                $response->getBody()->write($result);
                return $response;
            }
        );
        // --------------------------------------------------------------------------------

    }

    public function __destruct()
    {
        App::$mainApp->run();
    }
}
