<?php

namespace Yuri\Slim\controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Yuri\Slim\app\App;
use Yuri\Slim\model\DemoModelForm;
use Yuri\Slim\service\DemoService;

/**
 * @OA\Info(title="Demo API", version="0.1")
 */
class DemoController extends DemoService
{
    /**
     * @OA\Post(
     *  path="/demo_service/test", tags={"Demo Service"}, 
     *  @OA\RequestBody(
     *      @OA\MediaType(
     *          mediaType="application/json",
     *          @OA\Schema(
     *              @OA\Property(property="property_1", type="string"),
     *              @OA\Property(property="property_2", type="string"),
     *              @OA\Property(property="property_3", type="string")
     *          )
     *      )
     *  ),
     *  @OA\Response (response="200", description="Success"),
     *  @OA\Response (response="404", description="Not Found"),
     * )
     */
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
