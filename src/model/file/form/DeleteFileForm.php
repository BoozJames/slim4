<?php

namespace Yuri\Slim\model\file\form;

use Exception;
use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\Model;

class DeleteFileForm extends Model implements JsonSerializable
{
    public string $token = "";
    public string $id = "";

    public function __construct(Request $request)
    {
        $params = $request->getParsedBody();
        foreach ($params as $key => $value) {
            if (empty($value)) {
                throw new Exception(FORM_INPUT_STATUS['empty_params']);
            }
        }

        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'token' => $this->token,
            'id' => $this->id
        );
    }
}
