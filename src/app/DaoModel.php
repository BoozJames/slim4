<?php

namespace Yuri\Slim\app;

use Exception;

class DaoModel
{

    public function __construct($child, $params)
    {
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
