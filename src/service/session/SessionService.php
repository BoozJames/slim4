<?php

namespace Yuri\Slim\service\session;

use Exception;
use Yuri\Slim\helper\Jwt;
use Yuri\Slim\model\users\dao\SessionDao;

class SessionService
{
    public static function verify(string $token = ""): bool
    {
        try {
            if (strlen($token) === 0) {
                throw new Exception(SESSION_SERVICE['token_empty']);
            }

            $tokenArray = Jwt::parseToken($token);
            if (!$tokenArray) {
                throw new Exception(SESSION_SERVICE['invalid_token']);
            }

            $match = array(
                'user_id' => $tokenArray->user_id,
                'time' => $tokenArray->time,
                'key' => $tokenArray->key
            );
            $session = SessionDao::where($match)->first();
            if (!$session) {
                throw new Exception(SESSION_SERVICE['no_session']);
            }

            $jwt = array(
                'token' => $token,
                'signature' => $session->signature
            );

            $payload = Jwt::validate($jwt);
            if (!$payload) {
                throw new Exception(SESSION_SERVICE['no_payload']);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public static function save(
        array $tokenArray = array(),
        string $signature = ""
    ): bool {
        if (empty($tokenArray)) {
            throw new Exception(SESSION_SERVICE['token_empty']);
        }

        if (strlen($signature) === 0) {
            throw new Exception(SESSION_SERVICE['no_signature']);
        }

        if (
            !array_key_exists('time', $tokenArray) ||
            !array_key_exists('key', $tokenArray) ||
            !array_key_exists('user_id', $tokenArray)
        ) {
            throw new Exception(SESSION_SERVICE['no_property']);
        }

        SessionDao::where(
            'user_id',
            $tokenArray['user_id']
        )->delete();

        SessionDao::create([
            'time' => $tokenArray['time'],
            'key' => $tokenArray['key'],
            'user_id' => $tokenArray['user_id'],
            'signature' => $signature
        ])->save();

        return true;
    }
}
