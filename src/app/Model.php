<?php

namespace Yuri\Slim\app;

use Exception;

class Model
{
    public function __construct($child, $params)
    {
        foreach ($child as $key => $value) {
            if (!is_callable($key)) {
                if (!property_exists($params, $key)) {
                    if (!array_key_exists($key, $params)) {
                        throw new Exception($key . " property not found.");
                    } else {
                        $child->$key = $params[$key];
                    }
                } else {
                    $child->$key = $params->$key;
                }
            }
        }
    }
}
