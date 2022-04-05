<?php

namespace Yuri\Slim\model\file\form;

use Exception;
use JsonSerializable;
use Yuri\Slim\app\Model;
use Psr\Http\Message\ServerRequestInterface as Request;

class FileTokenForm extends Model implements JsonSerializable
{
    public string $token = "";
    public string $path = "";

    public string $type = "";
    public string $filename = "";
    public string $status = "";

    public function __construct(Request $request)
    {
        // $params = json_decode(base64_decode($args['token']));
        $req = $request->getParsedBody();

        if (empty($req['token']) || empty($req['path'])) {
            throw new Exception(FORM_INPUT_STATUS['empty_params']);
        }

        if (strpos($req['path'], "..") !== false) {
            throw new Exception(FILE_SERVICE['unsupported_string']);
        }

        $params = array(
            'token' => $req['token'],
            'path' => $req['path'],
            'type' => FILE_TYPE['file'],
            'filename' => "",
            'status' => FILE_STATUS['created']
        );

        parent::__construct($this, $params);
    }

    public function jsonSerialize()
    {
        return array(
            'token' => $this->token,
            'path' => $this->path,
            'filename' => $this->filename,
            'type' => $this->type,
            'status' => $this->status
        );
    }
}
