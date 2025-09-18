<?php
declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\QuemSomosController;
use App\Controllers\ContatoController;
use App\Controllers\ProdutoController;
use App\Controllers\NotFoundController; // 🔹 garante o fallback

// Normaliza a URI
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$basePath = '/saborCaseiro_MVC/public'; 
$uri = str_replace($basePath, '', $uri);

if ($uri === '' || $uri === '/') {
    $uri = '/home'; 
}

// 🔹 Mapeamento de rotas fixas
$pages = [
    '/home'           => [HomeController::class, 'index'],
    '/quem-somos'     => [QuemSomosController::class, 'index'],
    '/contato'        => [ContatoController::class, 'index'],
    '/contato/enviar' => [ContatoController::class, 'enviar'],
    '/produtos'       => [ProdutoController::class, 'index'],
];

// 🔹 Rotas dinâmicas: /produto/{id}
if (preg_match('#^/produto/(\d+)$#', $uri, $matches)) {
    $controller = new ProdutoController();
    $controller->detalhe((int)$matches[1]);
    exit;
}

// 🔹 Fallback seguro (se rota não existir)
if (isset($pages[$uri])) {
    [$controllerClass, $method] = $pages[$uri];
} else {
    $controllerClass = NotFoundController::class;
    $method = 'index';
}

// 🔹 Cria o controller e chama o método
$controller = new $controllerClass();
$controller->$method();
