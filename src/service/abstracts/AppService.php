<?php

namespace Yuri\Slim\service\abstracts;

use JsonSerializable;
use ReflectionClass;

abstract class AppService implements JsonSerializable
{
    public int $code = QUERY_STATUS['success'];

    public $message = "";

    public function __construct()
    {
        $classObj = new ReflectionClass($this);
        $mObj = $classObj->getMethods();
        $methods = array_values(array_filter($mObj, fn ($v) => (str_contains($v->class, APP_CONTROLLER) !== false) && ($v->name !== "__construct")));
        foreach ($methods as $value) {
            $this->{$value->name}();
        }
    }

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
