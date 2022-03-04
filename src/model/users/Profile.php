<?php

namespace Yuri\Slim\model\users;

use JsonSerializable;
use Yuri\Slim\app\DaoModel;
use Yuri\Slim\model\users\dto\AccountsDto;

class Profile extends DaoModel implements JsonSerializable
{
    public string $user_id = "";
    public string $first_name = "";
    public string $last_name = "";
    public string $mid_name = "";
    public string $ext_name = "";
    public string $email = "";
    public string $address = "";
    public string $usr_typ_cd = "";

    public function __construct(AccountsDto $args)
    {
        $params = clone($args);
        $params->user_id = "";
        $params->first_name = $args->fname;
        $params->last_name = $args->lname;
        $params->mid_name = $args->mname;
        $params->ext_name = $args->ext;
        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'user_id' => $this->user_id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'mid_name' => $this->mid_name,
            'ext_name' => $this->ext_name,
            'email' => $this->email,
            'address' => $this->address,
            'usr_typ_cd' => $this->usr_typ_cd
        );
    }
}
