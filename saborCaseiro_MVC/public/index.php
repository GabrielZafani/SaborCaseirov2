<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\QuemSomosController;
use App\Controllers\ContatoController;

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uriParts = explode('/', $uri);

$basePath = 'saborCaseiro_MVC/public';
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
    $uri = trim($uri, '/');
    $uriParts = explode('/', $uri);
}

switch ($uriParts[0]) {
    case '':
    case 'home':
        (new HomeController())->index();
        break;

    case 'quem-somos':
        (new QuemSomosController())->index();
        break;

    case 'produtos':
        $controller = new HomeController();
        if (isset($uriParts[1]) && is_numeric($uriParts[1])) {
            $controller->detalhe((int)$uriParts[1]);
        } else {
            $controller->index();
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
