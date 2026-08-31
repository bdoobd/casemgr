<?php

namespace App\Controllers\admin;

use App\Core\BaseController;
use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Models\User as ModelsUser;

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

            $found = ModelsUser::findOne(['username' => $data['username'], 'role_id' => $data['role_id']]);

            echo '<pre>';
            var_dump($found);
            echo '</pre>';

            // NOTE: Нужен метод для выборки данных по какому то фильтру, в этом случае выбрать запись по имени и если такая есть, то пользователь с данным именем уже существует

            // TODO: Сравнить пароль и пароль-подтверждение на совпадение, если не совпадают выбросить исключение

            // TODO: Хешировать пароль и записать в массив, скажем в поле password_hash

            // TODO: Собрать записываемые данные в ассоциативный. массив ['поле БД' => 'значение']

            // TODO: Передать массив в метод (базовый?) записи данных
        }


        $markup = $view->render($data);

        return new Response($markup);
    }
}
