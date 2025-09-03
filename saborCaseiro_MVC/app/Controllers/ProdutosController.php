<?php
namespace App\Controllers;

use App\Models\Produto;

class ProdutoController
{
    private $produtoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto();
    }

    // /produtos → lista todos
    public function index()
    {
        $produtos = $this->produtoModel->getAll();
        require __DIR__ . '/../Views/produtos-lista.phtml';
    }

    // /produto/{id} → detalhe
    public function show($id)
    {
        $produto = $this->produtoModel->getById($id);
        if (!$produto) {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
            return;
        }

        require __DIR__ . '/../Views/produto-detalhe.phtml';
    }
}
