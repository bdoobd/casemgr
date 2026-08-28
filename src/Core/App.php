<?php

namespace App\Core;

use App\Core\Request;
use Dotenv\Dotenv;

class App
{
    public static App $app;
    public static string $ROOTPATH = '';
    public Router $router;
    public Request $request;
    public Response $response;
    public DBC $db;

    public function __construct(string $path)
    {
        self::$app = $this;
        self::$ROOTPATH = $path;
        $this->request = new Request();
        $this->router = new Router($this->request);

        $dotnev = Dotenv::createImmutable(self::$ROOTPATH);
        $dotnev->load();

        $this->db = new DBC();
    }

    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $output = $this->router->dispatch($uri);
        $output->send();
    }
}
