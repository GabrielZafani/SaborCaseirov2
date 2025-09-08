<?php
namespace App\Controllers;

use App\Models\Produto;
use App\Core\Controller;

class ProdutoController extends Controller
{
    private $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto(); // Model já conecta ao banco
    }

    // Catálogo de produtos
    public function index()
    {
        $produtos = $this->produtoModel->getAll();
        $this->render("produtos", ["produtos" => $produtos]);
    }

    // Página de detalhes de um produto
    public function show($id)
    {
        $produto = $this->produtoModel->getById($id);

        if (!$produto) {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
            return;
        }

        $this->render("produto", ["produto" => $produto]);
    }
}
