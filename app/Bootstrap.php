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
        $this->setupDatabase();
        return new Http();
    }

    public function setupDatabase()
    {
        Connection::setup();
    }
}