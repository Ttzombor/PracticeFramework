<?php

namespace App\Http\Middleware;

class BaseMiddleware extends Middleware
{
    public function check()
    {
        return parent::check();
    }
}
