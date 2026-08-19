<?php

namespace App\Core;

class App
{
    public static App $app;
    public Router $router;

    public function __construct()
    {
        self::$app = $this;
        $this->router = new Router();
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        // $uri = rtrim($_SERVER['QUERY_STRING'], '\/');
        // $uri = $_SERVER['QUERY_STRING'];

        $this->router->dispatch($uri);
    }
}
