<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class Task
{
    public function index(Request $request)
    {

        $method = $request->getMethod();

        return new Response("Task controller {$method}");
    }
}
