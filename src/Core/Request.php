<?php

namespace App\Core;

class Request
{

    public function isGet(): bool
    {
        return $this->getMethod() === 'get';
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}
