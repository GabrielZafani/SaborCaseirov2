<?php
namespace App\Controllers;

use App\Models\Produto;

class HomeController
{
    private $produtoModel;

    public function __construct()
    {
        $pdo = new \PDO("mysql:host=localhost;dbname=projeto", "root", "");
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->produtoModel = new Produto($pdo);
    }

    public function index()
    {
        // Pega os 3 primeiros produtos, por exemplo
        $produtosDestaque = $this->produtoModel->getDestaques(3);

        require __DIR__ . '/../Views/home.phtml';
    }
}
