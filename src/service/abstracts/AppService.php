<?php

namespace Yuri\Slim\service\abstracts;

use JsonSerializable;

abstract class AppService implements JsonSerializable
{
    public int $code = QUERY_STATUS['success'];
    public $message = "";

    public function getResponse()
    {
        return json_encode($this);
    }

    public function jsonSerialize()
    {
        return array(
            'code' => $this->code,
            'message' => $this->message
        );
    }
}
