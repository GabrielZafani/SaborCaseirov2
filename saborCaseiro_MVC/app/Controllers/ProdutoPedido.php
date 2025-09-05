<?php
namespace App\Controllers;

use App\Models\Produto;
use App\Models\Pedido;

class ProdutoPedidoController
{
    private $produtoModel;
    private $pedidoModel;

    public function __construct()
    {
        $this->produtoModel = new Produto();
        $this->pedidoModel  = new Pedido();
    }

    // Listar todos os produtos
    public function listarProdutos()
    {
        $produtos = $this->produtoModel->getAll();
        require __DIR__ . "/../../views/produtos/listar.php";
    }

    // Exibir detalhes de um produto
    public function verProduto($id)
    {
        $produto = $this->produtoModel->getById($id);
        require __DIR__ . "/../../views/produtos/detalhes.php";
    }

    // Criar um novo pedido para um produto
    public function criarPedido($dados)
    {
        if (!isset($dados['produto_id'], $dados['quantidade'], $dados['cliente'])) {
            throw new \Exception("Dados insuficientes para criar pedido!");
        }

        $produto = $this->produtoModel->getById($dados['produto_id']);

        if (!$produto) {
            throw new \Exception("Produto não encontrado!");
        }

        $pedidoId = $this->pedidoModel->criar([
            'produto_id' => $dados['produto_id'],
            'quantidade' => $dados['quantidade'],
            'cliente'    => $dados['cliente'],
            'valor_total'=> $produto['preco'] * $dados['quantidade']
        ]);

        return $pedidoId;
    }

    // Listar pedidos
    public function listarPedidos()
    {
        $pedidos = $this->pedidoModel->getAll();
        require __DIR__ . "/../../views/pedidos/listar.php";
    }

    // Ver detalhes de um pedido
    public function verPedido($id)
    {
        $pedido = $this->pedidoModel->getById($id);
        require __DIR__ . "/../../views/pedidos/detalhes.php";
    }
}
