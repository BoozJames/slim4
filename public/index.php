<?php

use Yuri\Slim\http\Web;

// /* Remove this line when deploying the application */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* end of line to remove */

require __DIR__ . "/../vendor/autoload.php";

new Web();
