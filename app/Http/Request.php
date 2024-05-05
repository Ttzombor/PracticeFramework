<?php

namespace App\Http;

class Request
{
    public static function getUri()
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            return '/';
        }
        $uri = $_SERVER['REQUEST_URI'];
        if (substr($uri, -1) === '/') {
            return mb_substr($uri, 0, -1);
        }
        if (strpos($uri, '?') !== false) {
            return strstr($uri, '?', true);
        }
        return $uri;
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