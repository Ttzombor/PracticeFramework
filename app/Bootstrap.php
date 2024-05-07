<?php

namespace App;

use App\Database\Connection;
use App\Http\Http;

class Bootstrap
{
    public static function create()
    {
        return new self();
    }

    public function start()
    {
        return new Http();
    }
}
