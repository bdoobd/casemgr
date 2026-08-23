<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;

class Task extends BaseController
{
    public function index(Request $request)
    {
        $view = new View($this->route);

        $method = '<p>Method: ' . strtoupper($request->getMethod()) . '</p>';

        $out = '';

        foreach ($this->route as $key => $value) {
            $out .= "<p>{$key} => {$value}</p>";
        }

        $markup = $view->render(['methos' => $method, '$out' => $out]);

        // return new Response("Task controller {$method} / {$out}");
        return new Response($markup);
    }
}
