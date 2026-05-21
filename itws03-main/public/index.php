<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';

use Framework\Router;
use Framework\Session;

Session::start();

require '../helpers.php';

$router = new Router();

$routes = require basePath('routes.php');

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$scriptPath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));

if ($scriptPath !== '/' && $scriptPath !== '.' && strpos($uri, $scriptPath) === 0) {
    $uri = substr($uri, strlen($scriptPath));
}

if ($uri === '') {
    $uri = '/';
}

$router->route($uri);

