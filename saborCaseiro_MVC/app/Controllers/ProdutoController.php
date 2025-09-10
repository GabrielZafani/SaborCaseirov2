<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Produto;

class ProdutoController extends Controller
{
    private $produto;

    public function __construct()
    {
        $this->produto = new Produto();
    }

    public function index()
    {
        $produtos = $this->produto->getAll();
        $this->render('produtos', ['produtos' => $produtos]);
    }

    public function detalhe(int $id)
    {
        $produto = $this->produto->getById($id);

        if (!$produto) {
            echo "<p>Produto não encontrado!</p>";
            return;
        }

        $this->render('produto', ['produto' => $produto]);
    }
}
