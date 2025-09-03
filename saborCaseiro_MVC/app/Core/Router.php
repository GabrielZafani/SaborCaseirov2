<?php
namespace App\Core;

class Router
{
    public function run()
    {
        // pega a url da query string, ex: index.php?url=home
        $url = $_GET['url'] ?? 'home';

        // separa em partes (caso venha algo como produto/detalhe/1)
        $url = explode('/', $url);

        // primeira parte da URL define o controller
        $controllerName = ucfirst($url[0]) . 'Controller';
        $method = $url[1] ?? 'index';

        // caminho do controller
        $controllerFile = __DIR__ . '/../Controllers/' . $controllerName . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;

            $controllerClass = "App\\Controllers\\$controllerName";
            $controller = new $controllerClass();

            if (method_exists($controller, $method)) {
                // chama o método do controller
                $controller->$method();
            } else {
                echo "Método <b>$method</b> não encontrado em $controllerName.";
            }
        } else {
            echo "Controller <b>$controllerName</b> não encontrado.";
        }
    }
}
