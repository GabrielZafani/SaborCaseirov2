<?php
namespace App\Controllers;

class HomeController {
    private $produtos;

    public function __construct() {
        // Dados de exemplo para produtos, depois substitua pelo DB
        $this->produtos = [
            1 => [
                'nome' => 'Bolo de Chocolate',
                'valor' => 45.50,
                'foto' => 'bolo-chocolate.jpg',
                'destaque' => true,
            ],
            2 => [
                'nome' => 'Bolo de Cenoura',
                'valor' => 39.90,
                'foto' => 'bolo-cenoura.jpg',
                'destaque' => false,
            ],
            3 => [
                'nome' => 'Bolo Red Velvet',
                'valor' => 59.00,
                'foto' => 'bolo-red-velvet.jpg',
                'destaque' => true,
            ],
        ];
    }

    public function index() {
        // Passa os produtos para a view
        $produtosDestaque = array_filter($this->produtos, function($produto) {
            return !empty($produto['destaque']);
        });

        require __DIR__ . '/../Views/home.php';
    }
}
