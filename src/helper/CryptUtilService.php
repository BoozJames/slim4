<?php

namespace Yuri\Slim\helper;

class CryptUtilService
{
    public static function encrypt($plainText): string
    {
        return password_hash($plainText, PASSWORD_DEFAULT);
    }

    public static function verify($password, $hash): bool
    {
        return password_verify($password, $hash);
    }
}
