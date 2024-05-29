<?php

$request = $_SERVER["REQUEST_URI"];

$routes = require 'routes.php';

function routerToController($uri, $routes) {
    $uri = parse_url($uri)['path'];

    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort(404);
    }
}

function abort($code = 404) {
    http_response_code($code);
    require __DIR__ . "/views/{$code}.php";
    die();
}


$uri = parse_url($request)['path'];

routerToController($uri, $routes);