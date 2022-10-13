<?php

namespace Yuri\Slim\http;

use Yuri\Slim\app\App;

class Web extends App
{
    public function __construct()
    {
        parent::__construct(APP_LINK, true);

        $classes = array_values(array_filter(array_diff(scandir(str_replace("http","controller", __DIR__)), array('.', '..')), fn ($c) => $c !== 'Web.php'));
        foreach ($classes as $class_file) {
            $name = "Yuri\Slim\controller\\".explode('.', $class_file)[0];
            new $name();
        }
    }

    public function __destruct()
    {
        App::$mainApp->run();
    }
}
