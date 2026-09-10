<?php

namespace App\Controllers\admin;

use App\Core\BaseController;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\DTO\CreateUserDTO;
use App\DTO\ShowUserWithRoleDTO;
use App\Models\Role;
use App\Models\User as ModelsUser;
use Exception;

class User extends BaseController
{
    public function index()
    {
        $view = new View($this->route);

        // $data = ModelsUser::findAll();
        $users = ModelsUser::fetchAllUsersWithRile();
        $data = array_map(fn($item) => ShowUserWithRoleDTO::fromArray($item), $users);

        echo '<pre>';
        var_dump($data);
        echo '</pre>';

        // echo '<pre>';
        // var_dump($data);
        // echo '</pre>';

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

            echo '<pre>';
            var_dump($user);
            echo '</pre>';

            //     $password_hash = password_hash($requestData['password'], PASSWORD_DEFAULT);

            //     $user['username'] = $requestData['username'];
            //     $user['password_hash'] = $password_hash;
            //     $user['role_id'] = $requestData['role_id'];

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

        // TODO: Полуить ID из Router
        // TODO: Получить данные пользователя по ID
        $found = ModelsUser::findOne(['id' => $this->route['id']]);

        if (!$found) {
            throw new Exception('User not found');
        }

        // TODO: Передать данные пользователя в View
        $viewData['user'] = $found;

        // TODO: Получить данные из формы
        if ($request->isPost()) {
            $requestData = $request->getRequestBody();

            // TODO: Если дисаблить поля пароля и подтверждения, то надо использовать isset
            // if (!empty($requestData['password'])) {
            //     if (($requestData['password'] === $requestData['passwordConfirm'])) {
            //         $requestData['password_hash'] = password_hash($requestData['password'], PASSWORD_DEFAULT);
            //         unset($requestData['password'], $requestData['passwordConfirm']);
            //     } else {
            //         throw new Exception('Passwords does not match');
            //     }
            // } else {
            //     unset($requestData['password'], $requestData['passwordConfirm'], $requestData['password_hash']);
            // }

            echo '<pre>';
            var_dump($requestData);
            echo '</pre>';
            $updates = [];
            foreach ($requestData as $attribute => $value) {
                if ($attribute == 'submit')
                    continue;
                $updates[$attribute] = $value;
            }
            $viewData['formdata'] = $updates;

            // echo '<pre>';
            // var_dump($updates);
            // echo '</pre>';


            // TODO: Обновить данные пользователя в базе данных
            // ModelsUser::update($updates);
        }

        $markup = $view->render($viewData);

        return new Response($markup);
    }
}
