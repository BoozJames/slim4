<?php

namespace Yuri\Slim\model\users;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Capsule\Manager as DB;

class DemoModel extends Model
{
    protected $table = "table_demo_model";

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    // sample static query / custom query
    public static function staticQuery()
    {
        $query = "select * from table_demo_model";
        return DB::select($query);
    }
}
