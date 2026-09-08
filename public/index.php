<?php

use App\Core\App;

require __DIR__ . '/../vendor/autoload.php';

$app = new App(dirname(__DIR__));

$app->router->add('/', ['controller' => 'home', 'action' => 'index']);
// Требуемые маршруты:
//  - controller/action
$app->router->add('/{controller}/{action}');
//  - controller/id/action 
$app->router->add('/{controller}/{id:\d+}/{action}');
//  - controller/id/action/cid 
$app->router->add('/{controller}/{id:\d+}/{action}/{cid:\d+}');
//  - admin/controller/action (use namespace)
$app->router->add('/admin/{controller}/{action}', ['namespace' => 'admin']);
//  - admin/controller/id/action (use namespace)
$app->router->add('/admin/{controller}/{id:\d+}/{action}', ['namespace' => 'admin']);
//  - admin/controller/id/action/cid (use namespace)
$app->router->add('/admin/{controller}/{id:\d+}/{action}/{cid:\d+}', ['namespace' => 'admin']);

try {
    $app->run();
} catch (Exception $e) {
    echo '<pre>';
    var_dump($e->getMessage());
    echo '</pre>';
}
// $app->run();
