<?php

namespace Yuri\Slim\model\users;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{

    protected $table = "users";

    protected $guarded = ['id'];
    
    // protected $hidden = ['password'];

    // protected $fillable = ['name', 'email', 'username', 'password'];
    
    public $timestamps = false;
}
