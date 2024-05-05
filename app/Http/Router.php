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
                    $middleware = new BaseMiddleware();
                    $middlewareClass = null;
                    foreach ($route['middleware'] as $newMiddleware => $params) {

                        if (class_exists($params)) {
                            $newMiddleware = $params;
                            $params = null;
                        }
                        if (!class_exists($newMiddleware)) {
                            throw new \Exception('Middleware not found');
                        }
                        if ($middlewareClass) {
                            /** @var MiddlewareInterface $newMiddleware */
                            $newMiddlewareClass = new $newMiddleware($params);
                            $middlewareClass->setNext($newMiddlewareClass);
                            $middlewareClass = $newMiddlewareClass;
                        } else {
                            /** @var MiddlewareInterface $newMiddleware */
                            $middlewareClass = new $newMiddleware($params);
                            $middleware->setNext($middlewareClass);
                        }
                    }
                    $route['middleware'] = $middleware;
                }
                return new self($uri, $route['page'], $route['type'], $route['middleware']);
            }
        }
         return new self($uri, '404', null, null);
    }



}