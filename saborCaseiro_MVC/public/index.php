<?php
spl_autoload_register(function($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

use App\Controllers\HomeController;
use App\Controllers\QuemSomosController;
use App\Controllers\ProdutoController;
use App\Controllers\ContatoController;

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uriParts = explode('/', $uri);

switch ($uriParts[0]) {
    case '':
    case 'home':
        $controller = new HomeController();
        $controller->index();
        break;

    case 'quem-somos':
        $controller = new QuemSomosController();
        $controller->index();
        break;

    case 'produto':
        $controller = new ProdutoController();
        if (isset($uriParts[1]) && is_numeric($uriParts[1])) {
            $controller->show((int)$uriParts[1]);
        } else {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>aa";
        }
        break;

    case 'contato':
        $controller = new ContatoController();
        if (isset($uriParts[1]) && $uriParts[1] === 'enviar' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->enviar();
        } else {
            $controller->index();
        }
        break;

    default:
        http_response_code(404);
        echo "<h1>Página não encontrada</h1>";
        break;
}
