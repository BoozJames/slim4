<?php

namespace Yuri\Slim\model\users\dao;

use Illuminate\Database\Eloquent\Model;

class UsersDao extends Model
{

    protected $table = "users";

    protected $guarded = ['id'];

    // protected $fillable = ['name', 'email', 'username', 'password'];
    
    public $timestamps = false;
}
