<?php

namespace Yuri\Slim\helper\database;

use Exception;
use Illuminate\Database\Capsule\Manager;
use Yuri\Slim\model\QueryResponse;

class UserTableManager
{
    public static function createUsersTable(): array
    {
        $queryResponse = new QueryResponse();
        try {
            Manager::schema()->dropIfExists('users');
            Manager::schema()->create('users', function ($table) {
                $table->id()->primaryKey();
                $table->string('user_id');
                $table->string('name');
                $table->string('email')->unique();
                $table->string('username')->unique();
                $table->string('password', 1024);
            });

            $queryResponse->message = "success";
            return $queryResponse->jsonSerialize();
        } catch (Exception $e) {
            $queryResponse->code = QUERY_STATUS['failed'];
            $queryResponse->message = $e->getMessage();
            return $queryResponse->jsonSerialize();
        }
    }

    public static function createUsersProfileTable(): array
    {
        $queryResponse = new QueryResponse();
        try {
            Manager::schema()->dropIfExists('user_profile');
            Manager::schema()->create('user_profile', function ($table) {
                $table->id();
                $table->string('user_id');
                $table->string('first_name');
                $table->string('last_name');
                $table->string('mid_name');
                $table->string('ext_name');
                $table->string('email');
                $table->string('address');
                $table->string('usr_typ_cd');
                $table->timestamps();
            });
            $queryResponse->message = "success";
            return $queryResponse->jsonSerialize();
        } catch (Exception $e) {
            $queryResponse->code = QUERY_STATUS['failed'];
            $queryResponse->message = $e->getMessage();
            return $queryResponse->jsonSerialize();
        }
    }

    public static function createSessionTable(): array
    {
        $queryResponse = new QueryResponse();
        try {
            Manager::schema()->dropIfExists('user_session');
            Manager::schema()->create('user_session', function ($table) {
                $table->id();
                $table->bigInteger('time');
                $table->string('key');
                $table->string('user_id');
                $table->string('signature');
                $table->timestamps();
            });
            $queryResponse->message = "success";
            return $queryResponse->jsonSerialize();
        } catch (Exception $e) {
            $queryResponse->code = QUERY_STATUS['failed'];
            $queryResponse->message = $e->getMessage();
            return $queryResponse->jsonSerialize();
        }
    }
}
