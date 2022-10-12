<?php

use Dotenv\Dotenv;
use Yuri\Slim\constant\Constant;
use Yuri\Slim\http\Web;

// /* Remove this line when deploying the application */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);
/* end of line to remove */

require __DIR__ . "/vendor/autoload.php";

$n = Dotenv::createImmutable(__DIR__);
$n->load();

new Constant();

new Web();
