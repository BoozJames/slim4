<?php

namespace Yuri\Slim\service\register;

use Yuri\Slim\model\users\form\AccountsForm;

interface IRegisterService 
{
    public function accounts(AccountsForm $accounts): string;
}
