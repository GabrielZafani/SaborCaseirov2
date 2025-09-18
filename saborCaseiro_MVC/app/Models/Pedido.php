<?php
namespace App\Models;

use PDO;

class ProdutoPedido
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=projeto;charset=utf8", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    // Criar um item de pedido
    public function criar($dados)
    {
        $stmt = $this->db->prepare("
            INSERT INTO produto_pedido (pedido_id, produto_id, quantidade) 
            VALUES (:pedido_id, :produto_id, :quantidade)
        ");
        $stmt->execute([
            ':pedido_id'  => $dados['pedido_id'],
            ':produto_id' => $dados['produto_id'],
            ':quantidade' => $dados['quantidade']
        ]);

        return $this->db->lastInsertId();
    }

    // Buscar todos os produtos de um pedido
    public function getProdutosDoPedido($pedidoId)
    {
        $stmt = $this->db->prepare("
            SELECT pp.*, p.nome, p.preco, p.imagem
            FROM produto_pedido pp
            JOIN produto p ON pp.produto_id = p.id
            WHERE pp.pedido_id = :pedido_id
        ");
        $stmt->execute([':pedido_id' => $pedidoId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Excluir todos os produtos de um pedido
    public function excluirPorPedido($pedidoId)
    {
        $stmt = $this->db->prepare("DELETE FROM produto_pedido WHERE pedido_id = :pedido_id");
        $stmt->execute([':pedido_id' => $pedidoId]);
    }
}
