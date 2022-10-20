<?php

namespace Yuri\Slim\helper;

class PhpSession
{
    public string $sessionId = "";

    public function __construct($sess_id = "")
    {
        $this->sessionId = $sess_id;

        $expiration = 3600 * 24;
        session_set_cookie_params($expiration);

        if (!empty($sess_id)) {
            session_id($this->sessionId);
        }

        session_start();
    }

    public function isActive($key)
    {
        return isset($_SESSION[$key]);
    }

    public function set($key, $value)
    {
        return ($_SESSION[$key] = $value) || false;
    }

    public function get($key)
    {
        return $_SESSION[$key];
    }

    public function getSession()
    {
        return $_SESSION;
    }

    public function close()
    {
        return session_destroy();
    }
}
