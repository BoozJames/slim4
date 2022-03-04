<?php

namespace Yuri\Slim\service\register;

use Yuri\Slim\model\users\dto\AccountsDto;

interface Register
{
    public static function accounts(AccountsDto $accounts): string;
}
