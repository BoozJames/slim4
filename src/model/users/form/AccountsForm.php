<?php

namespace Yuri\Slim\model\users\form;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\Model;

class AccountsForm extends Model implements JsonSerializable
{
    public string $user_id = "";
    public string $name = "";
    public string $username = "";
    public string $password = "";
    public string $account_type = "";
    public string $expiration = "";

    public function __construct(Request $request)
    {
        $req = $request->getParsedBody();
        $params = array(
            'user_id' => uniqid(),
            'name' => $req->name,
            'username' => $req->username,
            'password' => $req->password,
            'account_type' => $req->account_type,
            'expiration' => $req->expiration
        );
        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'user_id' => $this->user_id,
            'name' => $this->name,
            'username' => $this->username,
            'password' => $this->password,
            'account_type' => $this->account_type,
            'expiration' => $this->expiration
        );
    }
}
