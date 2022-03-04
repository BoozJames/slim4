<?php

namespace Yuri\Slim\model\users;

use JsonSerializable;
use Yuri\Slim\app\DaoModel;
use Yuri\Slim\helper\CryptUtilService;
use Yuri\Slim\helper\StringUtilService;
use Yuri\Slim\model\users\dto\AccountsDto;

class User extends DaoModel implements JsonSerializable
{
    public string $user_id = "";
    public string $name = "";
    public string $email = "";
    public string $username = "";
    public string $password = "";

    public function __construct(AccountsDto $args)
    {
        $params = clone($args);
        $params->user_id = uniqid();
        $params->name = StringUtilService::nameFormat($args);
        $params->password = CryptUtilService::encrypt($args->password);
        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'user_id' => $this->user_id,
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password
        );
    }
}
