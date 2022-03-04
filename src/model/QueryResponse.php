<?php

namespace Yuri\Slim\model;

use JsonSerializable;
use Yuri\Slim\helper\database\DBManager;

class QueryResponse extends DBManager implements JsonSerializable
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
