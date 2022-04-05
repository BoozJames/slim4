<?php

namespace Yuri\Slim\model\users;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    protected $table = "user_session";

    protected $guarded = ['id'];

    // public $timestamps = false;
}
