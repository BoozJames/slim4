<?php

namespace Yuri\Slim\model\users\dto;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\DtoModel;

class LoginDto extends DtoModel implements JsonSerializable
{
    public string $username = "";
    public string $password = "";
    public string $t = "";


    public function __construct(Request $request)
    {
        parent::__construct($this, $request);
    }

    public function jsonSerialize()
    {
        return array(
            'username' => $this->username,
            'password' => $this->password,
            't' => $this->t
        );
    }
}
