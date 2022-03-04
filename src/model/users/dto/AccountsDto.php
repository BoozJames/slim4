<?php

namespace Yuri\Slim\model\users\dto;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\DtoModel;

class AccountsDto extends DtoModel implements JsonSerializable
{
    public string $fname = "";
    public string $lname = "";
    public string $mname = "";
    public string $ext = "";
    public string $address = "";
    public string $email = "";
    public string $username = "";
    public string $password = "";
    public string $usr_typ_cd = "";

    public function __construct(Request $request)
    {
        parent::__construct($this, $request);
    }

    public function jsonSerialize()
    {
        return array(
            'fname' => $this->fname,
            'lname' => $this->lname,
            'mname' => $this->mname,
            'ext' => $this->ext,
            'address' => $this->address,
            'email' => $this->email,
            'username' => $this->username,
            'password' => $this->password,
            'usr_typ_cd' => $this->usr_typ_cd
        );
    }
}
