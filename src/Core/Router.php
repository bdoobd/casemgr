<?php

namespace App\Core;

use App\Core\Helper;
use App\Core\Response;
use Exception;
// use App\Controllers\About;

class Router
{
    protected array $routes = [];

    protected array $route = [];

    /**
     * Метод добавляет шаблон маршрута с таблицу маршрутов
     * для последующего сравнения маршрутов с URL вдресом
     *
     * @param string $url Строка с идентификаторами контроллера и методов
     * @param array $params Параметры для маршрута, если они не создаются автоматически 
     * регулярными выражениями или другие доп. параметры, например namespaces
     * 
     * @return void
     */
    public function add(string $url, array $params = []): void
    {
        $url = preg_replace('#\{([a-z]+):([^}]+)\}#', '(?P<$1>$2)', $url);
        $url = preg_replace('#\{([a-z-]+)\}#', '(?P<$1>[a-z-]+)', $url);
        $url = preg_replace('#/#', '\/', $url);
        $url = '#^' . $url . '$#';

        $this->routes[$url] = $params;
    }
    /**
     * Сверяет URL c таблицей маршрутизации созданной методом add
     * и добавляет его в свойство класса $route
     * 
     * @param string $url URL для сверки с таблицей маршрутов
     * 
     * @return bool
     */
    public function match(string $url): bool
    {

        $url = trim(parse_url($url, PHP_URL_PATH), '/');

        $url = $url == '' ? '/' : '/' . $url;

        foreach ($this->routes as $route => $param) {

            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {

                    if (is_string($key)) {
                        $param[$key] = $match;
                    }
                }

                if (!isset($param['namespace'])) {
                    $param['namespace'] = 'App\\Controllers';
                } else {
                    $param['namespace'] = 'App\\Controllers\\' . ucfirst($param['namespace']);
                }

                $this->route = $param;

                return True;
            }
        }
        return False;
    }

    /**
     * Метод возвращает таблицу маршрутов в виде ассоциативного массива
     *
     * @return array Таблица маршрутов
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    public function getRoute(): array
    {
        return $this->route;
    }

    public function dispatch(string $url)
    {

        if (!$this->match($url)) {
            throw new Exception("Route {$url} not found");
        }

        $controllerName = Helper::toStudlyCaps($this->route["controller"]);
        $controllerClass = $this->route['namespace'] . '\\' . $controllerName;

        if (!class_exists($controllerClass)) {
            throw new Exception("Class {$controllerClass} not excists", 404);
        }

        $controllerObject = new $controllerClass;

        $action_name = Helper::toCamelCase($this->route["action"]);
        if (!method_exists($controllerObject, $action_name)) {
            throw new Exception("Method {$action_name} not found in {$controllerName} controller",404);
        }

        // FIXME: Может есть смысл передать в аргументы скажем REQUEST
        $result = call_user_func([$controllerObject, $action_name]);

        // TODO: Попробовать отдать реультат как RESPOSE объект
        if ($result instanceof Response) {
            return $result;
        }

        return new Response($result);

    }
}
