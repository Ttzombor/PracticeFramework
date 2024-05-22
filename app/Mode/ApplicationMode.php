<?php

namespace App\Mode;

class ApplicationMode
{
    static function get()
    {
        $configs = require 'config/app.php';
        if (isset($configs['mode'])) {
            return $configs['mode'];
        } else {
            throw new \Exception("Mode configuration not found", 500);
        }
    }
}