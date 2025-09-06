<?php
namespace App\Controllers;

use App\Models\Produtos;   // atenção: plural
use App\Core\Controller;

class HomeController extends Controller {
    private $produto;

    public function __construct() {
        $this->produto = new Produtos();   // plural
    }

    public function index() {
        $produtos = $this->produto->getAll();
        $this->render('home', ['produtos' => $produtos]);
    }
}
