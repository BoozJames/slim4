<?php

namespace Yuri\Slim\http;

use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Yuri\Slim\app\App;
use Yuri\Slim\model\ServiceResponse;
use Yuri\Slim\model\users\form\AccountsForm;
use Yuri\Slim\model\users\form\LoginForm;
use Yuri\Slim\model\users\form\UsersForm;
use Yuri\Slim\service\database\CreateTableService;
use Yuri\Slim\service\login\ILoginService;
use Yuri\Slim\service\register\IRegisterService;

class Web extends App
{

    public function __construct(
        IRegisterService $registerService,
        ILoginService $loginService
    ) {
        parent::__construct("", true);

        // --------------------------------------------------------------------------------
        App::$mainApp->get(
            '/db/create/table/users',
            function (Request $request, Response $response, $args) {
                $result = CreateTableService::createUsersTable();
                $response->getBody()->write($result);
                return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
            }
        );

        App::$mainApp->post(
            '/api/register/account',
            function (Request $request, Response $response, $args) use ($registerService) {
                try {
                    $accountsForm = new AccountsForm($request);
                    $result = $registerService->accounts($accountsForm);
                    $response->getBody()->write($result);
                } catch (Exception $e) {
                    $serviceResponse = new ServiceResponse(QUERY_STATUS['failed'], $e->getMessage());
                    $response->getBody()->write(json_encode($serviceResponse));
                }
                return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
            }
        );

        App::$mainApp->post(
            '/api/login/attempt',
            function (Request $request, Response $response, $args) use ($loginService) {
                try {
                    $params = new LoginForm($request);
                    $result = $loginService->attempt($params);
                    $response->getBody()->write($result);
                } catch (Exception $e) {
                    $serviceResponse = new ServiceResponse(QUERY_STATUS['failed'], $e->getMessage());
                    $response->getBody()->write(json_encode($serviceResponse));
                }
                return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
            }
        );

        App::$mainApp->post(
            '/api/logout',
            function (Request $request, Response $response, $args) use ($loginService) {
                try {
                    $params = new UsersForm($request);
                    $result = $loginService->logout($params);
                    $response->getBody()->write($result);
                } catch (Exception $e) {
                    $serviceResponse = new ServiceResponse(QUERY_STATUS['failed'], $e->getMessage());
                    $response->getBody()->write(json_encode($serviceResponse));
                }
                return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
            }
        );
        // --------------------------------------------------------------------------------

    }

    public function __destruct()
    {
        App::$mainApp->run();
    }
}
