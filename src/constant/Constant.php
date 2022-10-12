<?php

namespace Yuri\Slim\constant;

class Constant
{
    public function __construct()
    {

        define('APP_LINK', env('APP_LINK'));

        define('DB', array(
            'driver' => env('DRIVER'),
            'host' => env('HOST'),
            'database' => env('DATABASE'),
            'username' => env('USERNAME'),
            'password' => env('PASSWORD'),
            'charset' => env('CHARSET'),
            'collation' => env('COLLATION'),
            'prefix' => env('PREFIX')
        ));

        define('TIMEZONE', env('TIME_ZONE'));

        define('JWT_KEY', env('JWT_KEY'));

        define('RESPONSE_TYPE', array(
            "json" => "application/json",
            "html" => "text/html",
            "xml" => "text/xml"
        ));

        define('REQUEST_TYPE', array(
            "json" => "application/json",
            "urlencoded" => "application/x-www-form-urlencoded"
        ));

        define('QUERY_STATUS', array(
            'success' => 1,
            'failed' => 2
        ));
    }
}
