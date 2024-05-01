<?php

namespace App\Http;

class Request
{
    public static function getUri()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return '/';
        }
        if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
            return strstr($_SERVER['REQUEST_URI'], '?', true);
        }
        return $_SERVER['REQUEST_URI'];
    }

    public static function getMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function getParam($name)
    {
        return $_REQUEST[$name] ?? null;
    }

    public static function getParams()
    {
        $params = [];
        foreach ($_REQUEST as $key => $value) {
            if ($value) {
                $params[$key] = $value;
            }
        }
        return $params;
    }
}