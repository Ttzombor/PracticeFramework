<?php

namespace App\Http;

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
                if ($route->middleware->check() == false) {
                    return Page::getPage('login');
                }
            }

            if ($route->type !== null) {
                $controller = new $route->type[0]($route->pageName);
                $method = $route->type[1];
                return $controller->$method();
            } else {
                return $route->pageName;
            }
        }
        return '404';
    }

}