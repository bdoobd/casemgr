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

    public function render(array $data = []): string
    {
        $layoutFile = App::$ROOTPATH . '/src/Views/layouts/' . $this->layout . '.php';

        \ob_start();
        include_once($layoutFile);

        $layoutFileContent = ob_get_clean();

        return $layoutFileContent;
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
