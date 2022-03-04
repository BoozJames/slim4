<?php

namespace Yuri\Slim\service\register;

use Exception;
use Yuri\Slim\helper\CryptUtilService;
use Yuri\Slim\model\QueryResponse;
use Yuri\Slim\model\users\dto\AccountsDto;
use Yuri\Slim\model\users\dao\ProfileDao;
use Yuri\Slim\model\users\dao\UsersDao;
use Yuri\Slim\model\users\Profile;
use Yuri\Slim\model\users\User;

class RegisterService implements Register
{
    public static function accounts(AccountsDto $acctDtls): string
    {
        $queryResponse = new QueryResponse();
        try {

            if (!in_array($acctDtls->usr_typ_cd, USR_TYP_CD)) {
                $msg = " user type code not recognize.";
                throw new Exception($acctDtls->usr_typ_cd . $msg);
            }
            
            $userModel = new User($acctDtls);
            $user = UsersDao::create($userModel->jsonSerialize());
            $user->save();

            $profileModel = new Profile($acctDtls);
            $profileModel->user_id = $user->user_id;
            $profile = ProfileDao::create($profileModel->jsonSerialize());
            $profile->save();

            $queryResponse->code = QUERY_STATUS[($user) ? 'success' : 'failed'];
            $queryResponse->message = array(
                'user_id' => $user->user_id,
                'user' => array(
                    'id' => $user->id,
                    'password' => array(
                        'password' => $acctDtls->password,
                        'hash' => $user->password,
                        'verify' => CryptUtilService::verify(
                            $acctDtls->password,
                            $user->password
                        )
                    )
                ),
                'profile' => array('id' => $profile->id)
            );
            return json_encode($queryResponse->jsonSerialize());
        } catch (Exception $e) {
            $queryResponse->code = QUERY_STATUS['failed'];
            $queryResponse->message = array(
                'class' => "RegisterService",
                'exception' => $e->getMessage()
            );
            return json_encode($queryResponse->jsonSerialize());
        }
    }
}
