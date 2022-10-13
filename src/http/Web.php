<?php

namespace Yuri\Slim\http;

use Yuri\Slim\app\App;

class Web extends App
{
    public function __construct()
    {
        parent::__construct(APP_LINK, true);

        $classes = array_values(array_diff(scandir(str_replace("http", "controller", __DIR__)), array('.', '..')));
        foreach ($classes as $class_file) {
            $name = APP_CONTROLLER . "\\" . str_replace(".php", "", $class_file);
            new $name();
        }
    }

    public function __destruct()
    {
        App::$mainApp->run();
    }
}
