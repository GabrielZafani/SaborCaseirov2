<?php
namespace App\Controllers;

use App\Models\Pedido;
use App\Models\ProdutoPedido;
use App\Models\Produto;
use App\Models\Cliente;

class PedidoController
{
    private $pedidoModel;
    private $produtoPedidoModel;
    private $produtoModel;
    private $clienteModel;

    public function __construct()
    {
        $this->pedidoModel       = new Pedido();
        $this->produtoPedidoModel = new ProdutoPedido();
        $this->produtoModel      = new Produto();
        $this->clienteModel      = new Cliente();
    }

    // Criar pedido completo (pedido + produtos)
    public function criarPedido($dados)
    {
        if (!isset($dados['cliente_id'], $dados['produtos']) || empty($dados['produtos'])) {
            throw new \Exception("Dados insuficientes para criar pedido!");
        }

        // Calcula valor total do pedido
        $valorTotal = 0;
        foreach ($dados['produtos'] as $item) {
            $produto = $this->produtoModel->getById($item['produto_id']);
            if (!$produto) {
                throw new \Exception("Produto não encontrado: " . $item['produto_id']);
            }
            $valorTotal += $produto['preco'] * $item['quantidade'];
        }

        // Cria o pedido
        $pedidoId = $this->pedidoModel->criar([
            'cliente_id' => $dados['cliente_id'],
            'valor_total'=> $valorTotal,
            'data_pedido'=> date('Y-m-d H:i:s'),
            'status'     => 'Pendente'
        ]);

        // Cria os produtos do pedido
        foreach ($dados['produtos'] as $item) {
            $this->produtoPedidoModel->criar([
                'pedido_id'  => $pedidoId,
                'produto_id' => $item['produto_id'],
                'quantidade' => $item['quantidade']
            ]);
        }

        return $pedidoId;
    }

    // Listar todos os pedidos
    public function listarPedidos()
    {
        $pedidos = $this->pedidoModel->getAllWithCliente();
        require __DIR__ . "/../../views/pedidos/listar.php";
    }

    // Ver detalhes de um pedido
    public function verPedido($id)
    {
        $pedido = $this->pedidoModel->getById($id);
        $cliente = $this->clienteModel->getById($pedido['cliente_id']);
        $produtos = $this->produtoPedidoModel->getProdutosDoPedido($id);

        require __DIR__ . "/../../views/pedidos/detalhes.php";
    }

    // Atualizar status de um pedido
    public function atualizarStatus($id, $status)
    {
        $this->pedidoModel->atualizarStatus($id, $status);
    }

    // Excluir pedido e seus produtos
    public function excluirPedido($id)
    {
        $this->produtoPedidoModel->excluirPorPedido($id);
        $this->pedidoModel->excluir($id);
    }
}
