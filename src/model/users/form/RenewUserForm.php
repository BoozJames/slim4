<?php

namespace Yuri\Slim\model\users\form;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\Model;

class RenewUserForm extends Model implements JsonSerializable
{
    public string $token = "";

    public string $user_id = "";

    public string $new_expiration = "";

    public function __construct(Request $request)
    {
        $params = $request->getParsedBody();
        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'token' => $this->token,
            'user_id' => $this->user_id,
            'new_expiration' => $this->new_expiration
        );
    }
}
