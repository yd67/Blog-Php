<?php

use App\Router;

require '../vendor/autoload.php';

define('ROOT', dirname(__DIR__)) ;

$router = new Router() ;

$router->route() ;