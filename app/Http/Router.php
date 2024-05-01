<?php

namespace App\Http;

use App\Http\Interface\MiddlewareInterface;
use App\Http\Middleware\BaseMiddleware;

class Router
{
    public function __construct(
        public $uri,
        public $pageName,
        public $type,
        public $middleware
    )
    {
    }

    private static $list = [];

    public static function get($uri, $pageName, $type = null, $middleware = null)
    {
        self::$list[] = [
            'uri' => $uri,
            'page' => $pageName,
            'type' => $type,
            'middleware' => $middleware
        ];
    }

    public static function post($uri, $pageName, $type = null, $middleware = null)
    {
        self::$list[] = [
            'uri' => $uri,
            'page' => $pageName,
            'type' => $type,
            'middleware' => $middleware
        ];
    }
    public static function matchRoute($uri)
    {
        foreach (self::$list as $route) {
            if ($route['uri'] === $uri) {
                if ($route['middleware']) {
                    $baseMiddleware = new BaseMiddleware();
                    foreach ($route['middleware'] as $middleware) {
                        /** @var MiddlewareInterface $middleware */
                        $middleware = new $middleware();
                        $baseMiddleware->setNext($middleware);
                    }
                    $route['middleware'] = $baseMiddleware;
                }
                return new static($uri, $route['page'], $route['type'], $route['middleware']);
            }
        }
         return new static($uri, '404', null, null);
    }



}