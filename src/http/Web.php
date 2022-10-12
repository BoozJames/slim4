<?php

namespace Yuri\Slim\http;

use Yuri\Slim\app\App;

class Web extends App
{

    public function __construct()
    {
        parent::__construct(APP_LINK, true);

        new WebDemo();
    }

    public function __destruct()
    {
        App::$mainApp->run();
    }
}
