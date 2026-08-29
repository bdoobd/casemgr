<?php

namespace App\Controllers\admin;

use App\Core\BaseController;
use App\Core\Response;
use App\Core\View;
use App\Models\User as ModelsUser;

class User extends BaseController {
    public function index() {
        $view = new View($this->route);

        $data = ModelsUser::findAll();

        $markup = $view->render(['name' => 'Admin User index', 'data' => $data]);

        // echo '<pre>';
        // var_dump('Admin User');
        // echo '</pre>';

        return new Response($markup);
    }
}