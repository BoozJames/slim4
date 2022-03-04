<?php

namespace Yuri\Slim\helper;

use \Exception;

class Jwt
{
    public static function generate(array $payload, string $key = ""): array
    {
        $jwt = "";

        $base64UrlPayload = Jwt::base64UrlEncode(json_encode($payload));
        $signature = Jwt::base64UrlEncode(
            hash_hmac(
                'sha256',
                $base64UrlPayload,
                (strlen($key) == 0) ? JWT_KEY : $key,
                true
            )
        );
        $jwt = array(
            'token' => $base64UrlPayload,
            'signature' => $signature
        );

        return $jwt;
    }

    public static function validate(array $jwt, string $key = ""): array
    {
        $payload = array();

        $payload = Jwt::parseToken($jwt['token']);
        $signatureProvided = $jwt['signature'];
        $base64UrlPayload = Jwt::base64UrlEncode(json_encode($payload));
        $base64UrlSignature = Jwt::base64UrlEncode(
            hash_hmac(
                'sha256',
                $base64UrlPayload,
                (strlen($key) == 0) ? JWT_KEY : $key,
                true
            )
        );

        if ($signatureProvided !== $base64UrlSignature) {
            throw new Exception("Invalid token");
        }

        return (array) $payload;
    }

    public static function parseToken(string $token)
    {
        return json_decode(base64_decode($token));
    }

    private static function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }
}
