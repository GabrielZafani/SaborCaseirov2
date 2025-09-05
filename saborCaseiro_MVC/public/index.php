<?php
declare(strict_types=1);

// Autoload do Composer
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\HomeController;
use App\Controllers\QuemSomosController;
use App\Controllers\ProdutosController;
use App\Controllers\ContatoController;
use App\Controllers\ProdutosController;

// Pega a URI
$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$uriParts = explode('/', $uri);

// Se seu projeto estiver em subpasta, ex: http://localhost/saborCaseiro_MVC/
// Defina o nome da pasta base:
$basePath = 'saborCaseiro_MVC/public'; 
if (strpos($uri, $basePath) === 0) {
    $uri = substr($uri, strlen($basePath));
    $uri = trim($uri, '/');
    $uriParts = explode('/', $uri);
}

// Roteamento
switch ($uriParts[0]) {
    case '':
    case 'home':
        (new HomeController())->index();
        break;

    case 'quem-somos':
        (new QuemSomosController())->index();
        break;

    case 'produtos':
<<<<<<< Updated upstream
    $controller = new ProdutosController();

    if (isset($uriParts[1]) && is_numeric($uriParts[1])) {
        // Detalhe de 1 produto
        $controller->show((int)$uriParts[1]);
    } else {
        // Catálogo de todos os produtos
        $controller->index();
    }
    break;

    case 'produto':
        $controller = new ProdutoController();
=======
        $controller = new ProdutosController();
>>>>>>> Stashed changes
        if (isset($uriParts[1]) && is_numeric($uriParts[1])) {
            $controller->show((int)$uriParts[1]);
        } else {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
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
