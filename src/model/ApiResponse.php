<?php

namespace Yuri\Slim\model;

use JsonSerializable;

class ApiResponse implements JsonSerializable
{
    private $responseData = array(
        'code' => QUERY_STATUS['success'],
        'message' => ""
    );

    public function setCode(int $code)
    {
        $this->responseData['code'] = $code;
    }

    public function getCode()
    {
        return $this->responseData['code'];
    }

    public function setMessage($msg)
    {
        $this->responseData['message'] = $msg;
    }

    public function getMessage()
    {
        return $this->responseData['message'];
    }

    public function jsonSerialize()
    {
        return $this->responseData;
    }
}
