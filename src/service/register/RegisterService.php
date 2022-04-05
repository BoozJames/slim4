<?php

namespace Yuri\Slim\service\register;

use Exception;
use Yuri\Slim\helper\CryptUtilService;
use Yuri\Slim\helper\database\DBManager;
use Yuri\Slim\model\users\form\AccountsForm;
use Yuri\Slim\model\users\Users;

class RegisterService extends DBManager implements IRegisterService
{
    public function accounts(AccountsForm $accountsForm): string
    {
        try {

            if (!in_array($accountsForm->account_type, USR_TYP_CD)) {
                $msg = " user type code not recognize.";
                throw new Exception($accountsForm->account_type . $msg);
            }

            $plainPassword = $accountsForm->password;

            $accountsForm->password = CryptUtilService::encrypt($plainPassword);

            $userCount = Users::select('expiration')->get()->count();

            if ($userCount > 0) {
                throw new Exception("user creation closed.");
            }

            $user = Users::create($accountsForm->jsonSerialize());
            $user->save();

            $this->setCode(QUERY_STATUS[($user) ? 'success' : 'failed']);
            $this->setMessage(array(
                'user_id' => $user->user_id,
                'user' => array(
                    'id' => $user->id,
                    'password' => array(
                        'password' => $accountsForm->password,
                        'hash' => $user->password,
                        'verify' => CryptUtilService::verify($plainPassword, $user->password)
                    )
                )
            ));
        } catch (Exception $e) {
            $this->setCode(QUERY_STATUS['failed']);
            $this->setMessage(array(
                'class' => "RegisterService",
                'exception' => $e->getMessage()
            ));
        }
        return json_encode($this->jsonSerialize());
    }
}
