<?php

namespace Yuri\Slim\service\database;

use Exception;
use Yuri\Slim\helper\database\UserTableManager;

class CreateTableService implements CreateTable
{
    public static function createUsersTable(): string
    {
        try {
            $result = array(
                'users' => UserTableManager::createUsersTable(),
                'user_session' => UserTableManager::createSessionTable()
            );

            return json_encode($result);
        } catch (Exception $e) {
            return json_encode($e);
        }
    }
}
