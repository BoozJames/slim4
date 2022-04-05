<?php

namespace Yuri\Slim\model\file\form;

use Exception;
use JsonSerializable;
use Yuri\Slim\app\Model;
use Psr\Http\Message\ServerRequestInterface as Request;

class NewFolderForm extends Model implements JsonSerializable
{
    public string $token = "";
    public string $path = "";
    public string $filename = "";
    public string $type = "";
    public string $status = "";

    public function __construct(Request $request)
    {
        $req = $request->getParsedBody();
        $counter = 0;
        foreach ($req as $key => $value) {
            if (empty($value)) {
                throw new Exception(FORM_INPUT_STATUS['empty_params']);
            }
            $counter++;
        }

        if ($counter != 3) {
            throw new Exception(FORM_INPUT_STATUS['incomplete']);
        }

        if ((strpos($req->filename, "..") !== false) || (strpos($req->filename, "/") !== false)) {
            throw new Exception(FILE_SERVICE['unsupported_foldername']);
        }

        $params = array(
            'token' => $req->token,
            'path' => $req->path,
            'filename' => $req->filename,
            'type' => FILE_TYPE['directory'],
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
