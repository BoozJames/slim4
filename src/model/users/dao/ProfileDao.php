<?php

namespace Yuri\Slim\model\users\dao;

use Illuminate\Database\Eloquent\Model;

class ProfileDao extends Model
{

    protected $table = "user_profile";

    protected $guarded = ['id']; 

    // public $timestamps = false;
}
