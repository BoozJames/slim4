<?php

namespace Yuri\Slim\service\login;

use Exception;
use Yuri\Slim\helper\CryptUtilService;
use Yuri\Slim\helper\Jwt;
use Yuri\Slim\model\QueryResponse;
use Yuri\Slim\model\users\dto\LoginDto;
use Yuri\Slim\model\users\dao\UsersDao;
use Yuri\Slim\service\session\SessionService;

class LoginService implements Login
{
    public static function attempt(LoginDto $crendetials): string
    {
        $queryResponse = new QueryResponse();
        try {
            $params = $crendetials->jsonSerialize();

            $payload = array(
                'user_id' => "",
                'key' => uniqid(),
                'time' => $params['t']
            );

            $match = array("username" => $params['username']);
            $verifyLogin = false;
            foreach (UsersDao::where($match)->cursor() as $user) {
                $verifyLogin = CryptUtilService::verify(
                    $params['password'],
                    $user->password
                );
                if ($verifyLogin) {
                    $payload['user_id'] = $user->user_id;
                    break;
                }
            }

            if (!$verifyLogin) {
                throw new Exception(LOGIN_STATUS['failed']);
            }

            $jwt = Jwt::generate($payload);

            if (SessionService::save($payload, $jwt['signature'])) {
                $queryResponse->message = array(
                    'isLogin' => $verifyLogin,
                    'token' => $jwt['token']
                );
            } else {
                throw new Exception(SESSION_SERVICE['save_failed']);
            }

            return json_encode($queryResponse->jsonSerialize());
        } catch (Exception $e) {
            $queryResponse->code = QUERY_STATUS['failed'];
            $queryResponse->message = array(
                'class' => "LoginService",
                'exception' => $e->getMessage()
            );
            return json_encode($queryResponse->jsonSerialize());
        }
    }
}
