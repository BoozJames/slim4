<?php

namespace Yuri\Slim\model\users\form;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\Model;

class LoginForm extends Model implements JsonSerializable
{
    public string $username = "";
    public string $password = "";
    public string $t = "";


    public function __construct(Request $request)
    {
        $params = $request->getParsedBody();
        parent::__construct($this, $params);
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
