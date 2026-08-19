<?php

namespace App\Core;

// use App\Controllers\Home;
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
        $url = preg_replace('#\/#', '\/', $url);
        $url = preg_replace('#\{([a-z-]+)\}#', '(?P<\1>[a-z-]+)', $url);
        $url = preg_replace('#\{([a-z]+):([^\}]+)\}#', '(?P<\1>\2)', $url);
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
        $url = ltrim($url, '\/');

        foreach ($this->routes as $route => $param) {

            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $param[$key] = $match;
                    }
                }

                
                $this->route = $param;
                
                return True;
                }

                echo '<pre>';
			    var_dump($route);
			    echo '</pre>';
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

    public function dispatch($uri)
    {
        $path = parse_url($uri, PHP_URL_PATH);

        if ($this->match($uri)) {
            echo '<pre>';
            var_dump($this->getRoute());
            echo '</pre>';
        }

        echo '<pre>';
        var_dump("Маршрут не найден {$path}");
        echo '</pre>';

        // if (array_key_exists($path, $this->routes)) {
        //     [$controller, $action] = $this->routes[$path];

        //     $controllerInstance = new $controller();
        //     echo $controllerInstance->$action();
        // } else {
        //     http_response_code(404);
        //     echo "404 Not Found";
        // }
    }
}
