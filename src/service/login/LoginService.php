<?php

namespace Yuri\Slim\service\login;

use DateTime;
use Exception;
use Yuri\Slim\helper\CryptUtilService;
use Yuri\Slim\helper\database\DBManager;
use Yuri\Slim\helper\Jwt;
use Yuri\Slim\model\users\form\LoginForm;
use Yuri\Slim\model\users\form\UsersForm;
use Yuri\Slim\model\users\Session;
use Yuri\Slim\model\users\Users;
use Yuri\Slim\service\session\SessionService;

class LoginService extends DBManager implements ILoginService
{
    public function attempt(LoginForm $crendetials): string
    {
        try {
            $params = $crendetials->jsonSerialize();

            $payload = array(
                'user_id' => "",
                'key' => uniqid(),
                'time' => $params['t']
            );

            $match = array("username" => $params['username']);
            $verifyLogin = false;
            foreach (Users::where($match)->cursor() as $user) {
                if (($user->account_type != USR_TYP_CD['admin']) && (new DateTime(date('m/d/Y')) >= new DateTime($user->expiration))) {
                    throw new Exception(LOGIN_STATUS['expired_account']);
                    break;
                }
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
                $this->setMessage(array(
                    'isLogin' => $verifyLogin,
                    'token' => $jwt['token']
                ));
            } else {
                throw new Exception(SESSION_SERVICE['save_failed']);
            }
        } catch (Exception $e) {
            $this->setCode(QUERY_STATUS['failed']);
            $this->setMessage(array(
                'class' => "LoginService",
                'exception' => $e->getMessage()
            ));
        }
        return json_encode($this->jsonSerialize());
    }

    public function logout(UsersForm $usersForm): string
    {
        try {
            if (!SessionService::verify($usersForm->token)) {
                throw new Exception(SESSION_SERVICE['invalid_token']);
            }

            $tokenArray = Jwt::parseToken($usersForm->token);
            $users = Session::where('user_id', $tokenArray->user_id)->delete();

            if (!$users) {
                throw new Exception(SESSION_SERVICE['failed_delete']);
            }

            $this->setMessage(SESSION_SERVICE['deleted']);
        } catch (Exception $e) {
            $this->setCode(QUERY_STATUS['failed']);
            $resp = array(
                'class' => 'LoginService',
                'exception' => $e->getMessage()
            );
            if ($e->getMessage() == SESSION_SERVICE['no_session']) {
                $resp['no_session'] = true;
            }
            $this->setMessage($resp);
        }

        return json_encode($this->jsonSerialize());
    }
}
