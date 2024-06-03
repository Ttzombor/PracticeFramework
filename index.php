<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use App\Bootstrap;
use App\Mode\ApplicationMode;
use App\Mode\DevelopmentMode;

require 'vendor/autoload.php';

if (ApplicationMode::get() == 'development') {
    DevelopmentMode::start();
}

require 'routes/routes.php';

$bootstrap = Bootstrap::create();

$response = $bootstrap->start();

return $response->send();
