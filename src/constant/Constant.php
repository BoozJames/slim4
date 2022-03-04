<?php

namespace Yuri\Slim\constant;

use Exception;

class Constant
{

    private const HEADER = array(
        "Access-Control-Allow-Origin" => "*",
        "Access-Control-Allow-Credentials" => "true",
        "Access-Control-Allow-Headers" => "*",
        "Access-Control-Allow-Methods" => "GET, PUT, DELETE, PATCH, OPTIONS",
        "Content-Encoding" => "none",
        "Access-Control-Max-Age" => 1200
    );

    private const RESPONSE_TYPE = array(
        "json" => "application/json",
        "html" => "text/html",
        "xml" => "text/xml"
    );

    private const REQUEST_TYPE = array(
        "json" => "application/json",
        "urlencoded" => "application/x-www-form-urlencoded"
    );

    private const DB = array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'test',
        'username' => 'admin',
        'password' => 'password',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => ''
    );
    
    private const TIME_ZONE = "Asia/Manila";

    private const HTTP_STATUS = array(
        'ok' => '200',
        'created' => '201',
        'non_auth_info' => '203',
        'no_content' => '204',
        'reset_content' => '205',
        'partial_content' => '206',
        'bad_request' => '400',
        'unauthorized' => '401',
        'payment_required' => '402',
        'forbidden' => '403',
        'not_found' => '404',
        'method_not_allowed' => '405',
        'not_acceptable' => '406',
        'proxy_auth_required' => '407',
        'request_timeout' => '408',
        'internal_server_error' => '500',
        'not_implemented' => '501',
        'bad_gateway' => '502',
        'service_unavailable' => '503',
        'gateway_timeout' => '504'
    );

    private const QUERY_STATUS = array(
        'success' => 1,
        'failed' => 2
    );

    private const JWT_KEY = "SldUX0tFWQ==";

    private const SESSION_SERVICE = array(
        'token_empty' => "Token is empty.",
        'no_property' => "Unable to find token property.",
        'no_signature' => "Signature is empty.",
        'save_failed' => "Failed to save session.",
        'no_payload' => "Session not verified.",
        'no_session' => "Session not found.",
        'invalid_token' => "Invalid token."
    );

    private const DTO = array(
        'no_property' => "property not found."
    );

    private const LOGIN_STATUS = array(
        'failed' => "Login failed."
    );

    private const USR_TYP_CD = array(
        'admin' => "ADM",
        'manager' => "MGR",
        'courier' => "CRR",
        'shopper' => "SHPR"
    );

    public function __construct()
    {
        define('HEADER', self::HEADER);
        define('RESPONSE_TYPE', self::RESPONSE_TYPE);
        define('REQUEST_TYPE', self::REQUEST_TYPE);
        define('DB', self::DB);
        define('TIMEZONE', self::TIME_ZONE);
        define('HTTP_STATUS', self::HTTP_STATUS);
        define('QUERY_STATUS', self::QUERY_STATUS);
        define('JWT_KEY', self::JWT_KEY);
        define('SESSION_SERVICE', self::SESSION_SERVICE);
        define('DTO', self::DTO);
        define('LOGIN_STATUS', self::LOGIN_STATUS);
        define('USR_TYP_CD', self::USR_TYP_CD);
    }
}
