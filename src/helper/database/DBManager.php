<?php

namespace Yuri\Slim\helper\database;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Events\Dispatcher;

class DBManager
{
    public function __construct()
    {
        $manager = new Manager();
        $manager->addConnection(DB);

        $manager->setEventDispatcher(new Dispatcher(new Container()));

        $manager->setAsGlobal();
        $manager->bootEloquent();
    }
}
