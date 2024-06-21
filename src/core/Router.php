<?php

namespace src\core;

use src\controllers\Controller;
use src\libs\alert\Alert;
use src\libs\middleware\Middleware;

class Router
{

    public const
        GET = 'GET',
        POST = 'POST',
        PATCH = 'PATCH',
        DEL = 'DELETE',
        PUT = 'PUT';

    private array $routes = [];

    /**
     * @param string $path
     * @param string $controller
     * @param string $method
     * @param string[] $middleware
     * @return void
     */
    public function add(string $path, string $controller, string $method, array $middleware = []): void
    {
        $this->routes[] = [
            'path' => $path,
            'controller' => $controller,
            'method' => $method,
            'middleware' => $middleware
        ];
    }

    public function run(): void
    {
        $action = $_GET['action'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === 'POST' && isset($_POST['_method'])){
            $method = $_POST['_method'];
        }
        if ($method === 'GET' && isset($_GET['_method'])){
            $method = $_GET['_method'];
        }


        foreach ($this->routes as $route) {
            if ($route['path'] === $action && $route['method'] === $method) {

                /** @var Middleware $middleware */
                foreach ($route['middleware'] as $middleware){
                    (new $middleware) ->before();
                }

                /** @var Controller $controller */
                $controller = new $route['controller'];
                match ($method){
                    'GET' => $controller->get(),
                    'POST' => $controller->post(),
                    'PATCH' => $controller->patch(),
                    'DELETE' => $controller->del(),
                    'PUT' => $controller->put(),
                };
                exit();
            }
        }
        //Entraine un nginx error
        //http_response_code(404);
        Alert::setAlert(['Erreur 404 - Page non trouvée'], true);
        /** @var Controller $defaultController */
        $defaultController = new $this->routes[0]['controller'];
        $defaultController->get();
    }
}