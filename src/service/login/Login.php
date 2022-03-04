<?php

namespace Yuri\Slim\service\login;

use Yuri\Slim\model\users\dto\LoginDto;

interface Login
{
    public static function attempt(LoginDto $credentials): string;
}
