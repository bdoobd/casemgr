<?php

namespace App\Controllers\admin;

use App\Core\BaseController;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\User as ModelsUser;
use Exception;

class User extends BaseController
{
    public function index()
    {
        $view = new View($this->route);

        $data = ModelsUser::findAll();

        $markup = $view->render(['name' => 'Admin User index', 'data' => $data]);

        return new Response($markup);
    }

    public function create(Request $request)
    {
        $view = new View($this->route);

        $data = [];

        if ($request->isPost()) {
            $data = $request->getRequestBody();
            // TODO: Проверить наличие пользоватея с таким же именем, если уже есть, выбросить испключение
            // echo '<pre>';
            // var_dump($data['username']);
            // echo '</pre>';
            // NOTE: Нужен метод для выборки данных по какому то фильтру, в этом случае выбрать запись по имени и если такая есть, то пользователь с данным именем уже существует

            if (ModelsUser::findOne(['username' => $data['username']])) {
                throw new Exception('User name exists');
            }

            // TODO: Сравнить пароль и пароль-подтверждение на совпадение, если не совпадают выбросить исключение
            if ($data['password'] !== $data['passwordConfirm']) {
                throw new Exception('Passwords does not match');
            }

            // TODO: Хешировать пароль и записать в массив, скажем в поле password_hash
            // echo '<pre>';
            // var_dump('Processing with password hashing');
            // echo '</pre>';
            $password_hash = password_hash($data['password'], PASSWORD_DEFAULT);
            // echo '<pre>';
            // var_dump($password_hash);
            // echo '</pre>';

            // TODO: Собрать записываемые данные в ассоциативный. массив ['поле БД' => 'значение']
            $user['username'] = $data['username'];
            $user['password_hash'] = $password_hash;
            $user['role'] = match ($data['role']) {
                '1' => 'admin',
                '2' => 'power',
                '3' => 'user',
            };

            // echo '<pre>';
            // var_dump($user);
            // echo '</pre>';
            // TODO: Передать массив в метод (базовый?) записи данных
            ModelsUser::save($user);
        }


        $markup = $view->render($data);

        return new Response($markup);
    }
}
