 app/Core/Router.php

class Router {
    protected $routes = [];

    public function add($route, $params = []) {
        $this->routes[$route] = $params;
    }

    public function dispatch($url) {
        foreach ($this->routes as $route => $params) {
            if ($url == $route) {
                $controller = 'App\Controllers\\' . $params['controller'];
                $action = $params['action'];
                $controllerObj = new $controller();
                $controllerObj->$action();
                return;
            }
        }
        // Página não encontrada
        http_response_code(404);
        echo "Página não encontrada";
    }
}
