<?php

namespace Yuri\Slim\model;

use JsonSerializable;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yuri\Slim\app\Model;

class DemoModelForm extends Model implements JsonSerializable
{
    public string $property_1 = "";
    public string $property_2 = "";
    public string $property_3 = "";

    public function __construct(Request $request)
    {
        $params = $request->getParsedBody();
        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'property_1' => $this->property_1,
            'property_2' => $this->property_2,
            'property_3' => $this->property_3
        );
    }
}
