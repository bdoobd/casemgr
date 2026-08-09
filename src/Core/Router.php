<?php

namespace App\Core;

use App\Controllers\Home;
use App\Controllers\About;

class Router
{
    protected array $routes = [
        '/' => [Home::class, 'index'],
        '/about' => [About::class, 'index'],
    ];

    public function dispatch($uri)
    {
       $path = parse_url($uri, PHP_URL_PATH);

        if (array_key_exists($path, $this->routes)) {
            [$controller, $action] = $this->routes[$path];

            $controllerInstance = new $controller();
            echo $controllerInstance->$action();
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}