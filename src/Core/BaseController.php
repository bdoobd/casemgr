<?php

namespace App\Core;

class BaseController
{
    public array $route;

    public function __construct($route)
    {
        $this->route = $route;
    }
}
