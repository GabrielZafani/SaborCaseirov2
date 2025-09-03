<?php
namespace App\Controllers;

class ProdutoController {
    private $produtos;

    public function __construct() {
        // Dados estáticos (exemplo). Depois substitua com DB.
        $this->produtos = [
            1 => [
                'nome' => 'Bolo de Chocolate',
                'valor' => 45.50,
                'foto' => 'bolo-chocolate.jpg',
                'descricao' => 'Delicioso bolo de chocolate com cobertura cremosa.',
                'destaque' => true,
            ],
            2 => [
                'nome' => 'Bolo de Cenoura',
                'valor' => 39.90,
                'foto' => 'bolo-cenoura.jpg',
                'descricao' => 'Bolo de cenoura com cobertura de chocolate.',
                'destaque' => false,
            ],
            3 => [
                'nome' => 'Bolo Red Velvet',
                'valor' => 59.00,
                'foto' => 'bolo-red-velvet.jpg',
                'descricao' => 'Bolo vermelho aveludado, super macio e saboroso.',
                'destaque' => true,
            ],
        ];
    }

    // 👉 Página "produtos" (listagem de todos)
    public function index() {
        $produtos = $this->produtos;

        require __DIR__ . '/../Views/produtos-lista.phtml';
    }

    // 👉 Página de um produto específico
    public function show($id) {
        if (!isset($this->produtos[$id])) {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
            return;
        }

        $produto = $this->produtos[$id];

        // Também passa produtos em destaque, exceto o atual
        $produtosDestaque = array_filter(
            $this->produtos,
            fn($p, $key) => !empty($p['destaque']) && $key != $id,
            ARRAY_FILTER_USE_BOTH
        );

        require __DIR__ . '/../Views/produto.phtml';
    }
}
