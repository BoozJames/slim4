<?php

namespace Yuri\Slim\model\users\dao;

use Illuminate\Database\Eloquent\Model;

class SessionDao extends Model
{

    protected $table = "user_session";

    protected $guarded = ['id'];

    // public $timestamps = false;
}
