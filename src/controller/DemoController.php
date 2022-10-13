<?php

namespace Yuri\Slim\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Yuri\Slim\app\App;
use Yuri\Slim\model\DemoModelForm;
use Yuri\Slim\service\DemoService;

class DemoController extends DemoService
{
    protected function demoTest($endpoint = "/demo_service/test")
    {
        App::$mainApp->post($endpoint, function (Request $request, Response $response, $args) {
            $demoModelForm = new DemoModelForm($request);
            $this->test($demoModelForm);
            $response->getBody()->write($this->getResponse());
            return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
        });
    }
}
