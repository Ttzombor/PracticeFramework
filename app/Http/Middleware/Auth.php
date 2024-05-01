<?php

namespace App\Http\Middleware;

class Auth extends Middleware
{
    public function check()
    {
        if (isset($_SESSION['user'])) {
            return parent::check();
        }
        return false;
    }
}
