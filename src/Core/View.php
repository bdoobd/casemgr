<?php

namespace App\Core;

class View
{
    protected array $route;
    protected string $layout = 'main';

    public function __construct(array $route)
    {
        $this->route = $route;
    }
    /**
     * Сборка шаблона и динамеческого содержимого страницы
     * 
     * @param array $data Данные для отображения на странице в виде ассоциативного массива
     * 
     * @return bool|string
     */
    public function render(array $data = []): string
    {
        $layoutFile = App::$ROOTPATH . '/src/Views/layouts/' . $this->layout . '.php';
        $content = $this->renderContent($data);

        ob_start();
        include_once($layoutFile);

        $layoutFileContent = ob_get_clean();

        return str_replace('{{content}}', $content, $layoutFileContent);
    }

    public function renderContent(array $data = []): string {
        $layoutFile = App::$ROOTPATH . '/src/Views/' . ucfirst($this->route['controller']) . '/' . $this->route['action'] . '.php';

        ob_start();
        extract($data);

        include_once($layoutFile);

        return ob_get_clean();
    }
    

    /**
     * Устанавливает макет интерфейса
     * 
     * @param string $layout Название макета
     * 
     * @return void
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
}
