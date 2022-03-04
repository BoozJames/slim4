<?php

namespace Yuri\Slim\app;

use Psr\Http\Message\ServerRequestInterface as Request;
use Exception;

class DtoModel
{

    public function __construct($child, Request $request)
    {
        $params = $request->getParsedBody();
        foreach ($child as $key => $value) {
            if (!is_callable($key)) {
                if (!property_exists($params, $key)) {
                    throw new Exception($key . " " . DTO['no_property']);
                }
                $child->$key = $params->$key;
            }
        }
    }
}
