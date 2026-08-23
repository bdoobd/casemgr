<?php

namespace App\Controllers;

use App\Core\Response;

class Task
{
    public function index() {
        return new Response("Task controller");
    }
} 