<?php
namespace App\Controllers;

use App\Models\Produto;
use PDO;

class ProdutoController
{
    private $produtoModel;

    public function __construct()
    {
        // Conexão PDO (NÃO mysqli)
        $dsn = "mysql:host=localhost;dbname=projeto;charset=utf8";
        $user = "root";   // ajuste se seu MySQL tiver senha
        $pass = "";

        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // injeta no model
        $this->produtoModel = new Produto($pdo);
    }

    public function index()
    {
        $produtos = $this->produtoModel->getAll();
        require __DIR__ . '/../Views/produtos.phtml';
    }

    public function show($id)
    {
        $produto = $this->produtoModel->getById($id);

        if (!$produto) {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
            return;
        }

        require __DIR__ . '/../Views/produto.phtml';
    }
}
