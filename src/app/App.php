<?php

namespace Yuri\Slim\app;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

use Slim\Factory\AppFactory;

class App 
{
    public static $mainApp;
    // public static $mainContainer;

    public function __construct($basePath = "", $displayErrorDetails = false)
    {

        date_default_timezone_set(TIMEZONE);

        App::$mainApp = AppFactory::create();

        App::$mainApp->addErrorMiddleware($displayErrorDetails, false, false);

        App::beforeHeaders();

        App::afterHeaders();

        App::jsonBodyParse();

        if (strlen($basePath) > 0) {
            App::$mainApp->setBasePath("/" . $basePath);
        }
    }

    // set headers before
    private static function beforeHeaders()
    {
        App::$mainApp->add(function (Request $request, RequestHandler $handler) {
            $response = $handler->handle($request);
            $existingContent = (string) $response->getBody();

            $response = new \Slim\Psr7\Response();
            foreach (HEADER as $key => $value) {
                $response->withHeader($key, $value);
            }
            $response->getBody()->write($existingContent);

            return $response;
        });
    }

    // set headers after
    private static function afterHeaders()
    {
        App::$mainApp->add(function (Request $request, RequestHandler $handler) {
            $response = $handler->handle($request);
            return $response->withHeader('Content-Type', RESPONSE_TYPE['json']);
        });
    }

    // for json body parse
    private static function jsonBodyParse()
    {
        App::$mainApp->add(function (Request $request, RequestHandler $handler) {
            $contentType = $request->getHeaderLine('Content-Type');
            if (strstr($contentType, REQUEST_TYPE['json'])) {
                $contents = json_decode(file_get_contents('php://input'));
                if (json_last_error() == JSON_ERROR_NONE) {
                    $request = $request->withParsedBody($contents);
                }
            }
            return $handler->handle($request);
        });
    }
}
