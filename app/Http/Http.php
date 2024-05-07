<?php

namespace App\Http;

use App\Container\Container;
use App\Http\Interface\HttpInterface;

class Http implements HttpInterface
{
    public function send()
    {
        $route = Router::matchRoute(Request::getUri());

        $page = $this->dispatch($route);

        try {
            Page::getPage($page);
        } catch (\Exception $exception) {
            return Page::get404Page();
        }
    }

    private function dispatch(mixed $route)
    {
        if ($route instanceof Router) {
            if ($route->middleware) {
                if ($page = $route->middleware->check()) {
                    if (is_string($page)) {
                        return Page::getPage($page);
                    }
                    if ($page == false) {
                        return Page::getPage('login');
                    }
                }
            }

            if ($route->type !== null) {
                if (isset($route->type[0]) && class_exists($route->type[0])) {
                    $controllerClass = $route->type[0];
                }
                $container = new Container();
                if ($container->has($controllerClass)) {
                    $controller = $container->get($controllerClass);
                } else {
                    $controller = new $controllerClass($route->pageName);
                }
                $method = $route->type[1];
                return $controller->$method();
            } else {
                return $route->pageName;
            }
        }
        return '404';
    }
}
