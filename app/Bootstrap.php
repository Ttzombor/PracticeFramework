<?php

namespace App;

use App\Mode\ApplicationMode;
use App\Database\Connection;
use App\Http\Http;
use App\Mode\DevelopmentMode;

class Bootstrap
{
    public static function create()
    {
        return new self();
    }

    public function start()
    {
        $response = new Http();
        if (ApplicationMode::get() == 'development') {
            require $_SERVER['DOCUMENT_ROOT'] . '/view/dev/resources_usages.phtml';
        }
        return $response;
    }

    public function mode()
    {
        
    }
}
