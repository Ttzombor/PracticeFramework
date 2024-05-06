<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use App\Bootstrap;

require 'vendor/autoload.php';
require 'routes/routes.php';

$bootstrap = Bootstrap::create();

$bootstrap->start()->send();
