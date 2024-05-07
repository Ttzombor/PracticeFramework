<?php

namespace App\Http;

class AbstractController
{
    private string $pageName;

    public function __construct(string $pageName = '/')
    {
        $this->pageName = $pageName;
    }

    public static function redirect($route)
    {
        header("Location: {$route}", true, 303);
        exit();
    }

    public function getParam($param)
    {
        return Request::getParam($param);
    }

    public function getParams()
    {
        return Request::getParams();
    }

    public function __call(string $name, array $arguments)
    {
        if (isset($this->pageName)) {
            return $this->pageName;
        }
        return null;
    }
}