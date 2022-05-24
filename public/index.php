<?php

use App\Router;

require '../vendor/autoload.php';

define('ROOT', dirname(__DIR__)) ;

session_start();

$router = new Router() ;

$router->route() ;