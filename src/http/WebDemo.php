<?php

namespace Yuri\Slim\http;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Yuri\Slim\app\App;
use Yuri\Slim\model\DemoModelForm;
use Yuri\Slim\service\DemoService;

class WebDemo extends DemoService
{

    private $app_name = "demo_service";

    public function __construct()
    {
        parent::__construct();

        $this->demoServiceTest("test");
    }

    private function demoServiceTest($e)
    {
        $endpoint = sprintf("/%s/%s", $this->app_name, $e);
        App::$mainApp->post($endpoint, function (Request $request, Response $response, $args) {
            $demoModelForm = new DemoModelForm($request);
            $this->test($demoModelForm);
            $response->getBody()->write($this->getResponse());
            return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
        });
    }
}
