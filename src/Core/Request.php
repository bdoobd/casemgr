<?php

namespace App\Core;

class Request
{
    /**
     * Проверяет является ли метод запроса методом GET
     * 
     * @return bool
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }
    /**
     * Проверяет является ли метод запроса методом POST
     * 
     * @return bool
     */
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }
    /**
     * Получает метод запроса
     * 
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function getRequestBody(): array
    {
        $data = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $data[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        if ($this->isPost()) {
            foreach ($_POST as $key => $value) {
                $data[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            }
        }

        return $data;
    }
}
