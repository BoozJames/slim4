<?php

namespace Yuri\Slim\model;

use JsonSerializable;

class ServiceResponse implements JsonSerializable
{
    public
        $code = QUERY_STATUS['success'],
        $message = "";

    public function jsonSerialize()
    {
        return array(
            'code' => $this->code,
            'message' => $this->message
        );
    }
}
