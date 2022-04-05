<?php

namespace Yuri\Slim\model\users\form;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\Model;

class UsersForm extends Model implements JsonSerializable
{
    public string $token = "";

    public string $user_type = "";

    public string $user_expiration = "";
    
    public int $user_number = 0;
    
    public int $page = 0;

    public int $page_size = 10;

    public function __construct(Request $request)
    {
        $req = $request->getParsedBody();
        if ($req->token) {
            $params = array(
                'token' => (($req->token) ? $req->token : ""),
                'user_type' => (($req->user_type) ? $req->user_type : ""),
                'user_expiration' => (($req->user_expiration) ? $req->user_expiration : ""),
                'user_number' => (($req->user_number) ? $req->user_number : 0),
                'page' => (($req->page) ? $req->page : 0),
                'page_size' => (($req->page_size) ? $req->page_size : 0)
            );
        }
        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'token' => $this->token,
            'user_type' => $this->user_type,
            'user_expiration' => $this->user_expiration,
            'user_number' => $this->user_number,
            'page' => $this->page,
            'page_size' => $this->page_size
        );
    }
}
