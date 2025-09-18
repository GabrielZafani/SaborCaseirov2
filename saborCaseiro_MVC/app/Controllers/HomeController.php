<?php
namespace App\Controllers;

use App\Models\Produto;
use App\Core\Controller;

class HomeController extends Controller {
    private $produto;

    public function __construct() {
        $this->produto = new Produto();
    }

    
    public function index() {
       
        $produtosDestaque = $this->produto->getDestaques();

        $this->render('home', [
            'produtosDestaque' => $produtosDestaque
        ]);
    }

    
    public function detalhe($id) {
        $produto = $this->produto->getById($id);

        if (!$produto) {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
            return;
        }

        $this->render('produto', [
            'produto' => $produto
        ]);
    }
}
