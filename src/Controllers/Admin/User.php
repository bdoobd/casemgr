<?php

namespace App\Controllers\admin;

use App\Core\BaseController;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\DTO\CreateUserDTO;
use App\DTO\ShowUserWithRoleDTO;
use App\DTO\UpdateUserDTO;
use App\Models\Role;
use App\Models\User as ModelsUser;
use Exception;

class User extends BaseController
{
    public function index()
    {
        $view = new View($this->route);

        $users = ModelsUser::fetchAllUsersWithRile();
        $data = array_map(fn($item) => ShowUserWithRoleDTO::fromArray($item), $users);

        $markup = $view->render(['name' => 'Admin User index', 'data' => $data]);

        return new Response($markup);
    }

    public function create(Request $request): Response
    {
        $view = new View($this->route);
        $roles = new Role();

        $viewData = ['roles' => $roles::findAll()];

        if ($request->isPost()) {
            $requestData = $request->getRequestBody();

            if (ModelsUser::findOne(['username' => $requestData['username']])) {
                throw new Exception('User name exists');
            }

            if ($requestData['password'] !== $requestData['passwordConfirm']) {
                throw new Exception('Passwords does not match');
            }

            $user = CreateUserDTO::fromArray($requestData);

            ModelsUser::save($user);
        }

        $markup = $view->render($viewData);

        return new Response($markup);
    }

    public function update(Request $request): Response
    {
        $view = new View($this->route);
        $roles = new Role();

        $viewData = ['roles' => $roles::findAll()];

        $found = ModelsUser::findOne(['id' => $this->route['id']]);

        if (!$found) {
            throw new Exception('User not found');
        }

        $viewData['user'] = $found;

        if ($request->isPost()) {
            $requestData = $request->getRequestBody();

            $update_user = UpdateUserDTO::fromArray($requestData);

            // echo '<pre>';
            // var_dump((array)$update_user);
            // echo '</pre>';

            $viewData['formdata'] = $update_user;

            // TODO: Обновить данные пользователя в базе данных
            ModelsUser::update((array)$update_user);
        }

        $markup = $view->render($viewData);

        return new Response($markup);
    }

    public function changePassword(Request $request): Response
    {
        if ($request->isPost()) {
            $requestData = $request->getRequestBody();

            if (isset($requestData['password']) and ($requestData['password'] !== $requestData['passwordConfirm'])) {
                throw new Exception('Passwords does not match');
            }

            if (($requestData['password'] === $requestData['passwordConfirm'])) {
                $requestData['password_hash'] = password_hash($requestData['password'], PASSWORD_DEFAULT);
            }
        }
        return new Response('Change password');
    }
}
