<?php

namespace Yuri\Slim\service\login;

use Yuri\Slim\model\users\form\LoginForm;
use Yuri\Slim\model\users\form\UsersForm;

interface ILoginService
{
    public function attempt(LoginForm $credentials): string;

    public function logout(UsersForm $usersForm): string;
}
