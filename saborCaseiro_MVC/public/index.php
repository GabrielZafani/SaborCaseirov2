<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\QuemSomosController;
use App\Controllers\ContatoController;
use App\Controllers\NotFoundController;
use App\Controllers\ProdutoController;

// Normaliza a URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/saborCaseiro_MVC/public'; 
$uri = str_replace($basePath, '', $uri);

if ($uri === '' || $uri === '/') {
    $uri = '/home'; 
}

$pages = [
    '/home'          => [HomeController::class, 'index'],
    '/quem-somos'    => [QuemSomosController::class, 'index'],
    '/contato'       => [ContatoController::class, 'index'],
    '/produtos'      => [ProdutoController::class, 'index'],
    '/contato/enviar'=> [ContatoController::class, 'enviar'],
];

// 🔹 Captura rotas do tipo /produto/{id}
if (preg_match('#^/produto/(\d+)$#', $uri, $matches)) {
    $controller = new ProdutoController();
    $controller->detalhe((int)$matches[1]);
    exit;
}

// Se não achar a rota, cai no NotFoundController
[$controllerClass, $method] = $pages[$uri] ?? [NotFoundController::class, 'index'];

$controller = new $controllerClass();
$controller->$method();
