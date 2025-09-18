<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function add($route, $controller, $action) {
        $this->routes[$route] = ['controller' => $controller, 'action' => $action];
    }

    public function dispatch($uri) {
        $uri = trim(parse_url($uri, PHP_URL_PATH), "/");

        if (array_key_exists($uri, $this->routes)) {
            $controllerName = "App\\Controllers\\" . $this->routes[$uri]['controller'];
            $action = $this->routes[$uri]['action'];

            if (class_exists($controllerName)) {
                $controller = new $controllerName();
                if (method_exists($controller, $action)) {
                    $controller->$action();
                    return;
                }
            }
        }

       
        http_response_code(404);
        echo "Página não encontrada!";
    }
}
