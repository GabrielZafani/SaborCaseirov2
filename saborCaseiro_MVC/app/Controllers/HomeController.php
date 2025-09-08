<?php
namespace App\Controllers;

use App\Models\Produto;

class HomeController {
    private $produto;

    public function __construct() {
        $this->produto = new Produto();
    }

    public function index() {
        $produtos = $this->produto->getAll();
        include __DIR__ . '/../Views/produtos.phtml';
    }

    public function detalhe($id) {
        $produto = $this->produto->getById($id);
        include __DIR__ . '/../Views/produto.phtml';
    }
}
