<?php
namespace App\Models;

use PDO;

class ProdutoPedido
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Adicionar produto a um pedido
    public function addProduto($produto_id, $pedido_id, $quantidade, $valor)
    {
        $stmt = $this->db->prepare("
            INSERT INTO produto_pedido (produto_id, pedido_id, quantidade, valor)
            VALUES (:produto_id, :pedido_id, :quantidade, :valor)
        ");
        $stmt->bindParam(':produto_id', $produto_id);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);
        return $stmt->execute();
    }

    // Buscar todos os produtos de um pedido
    public function getByPedido($pedido_id)
    {
        $sql = "SELECT pp.*, p.nome, p.peso, p.imagem
                FROM produto_pedido pp
                LEFT JOIN produto p ON pp.produto_id = p.id
                WHERE pp.pedido_id = :pedido_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar produto em um pedido
    public function update($id, $quantidade, $valor)
    {
        $stmt = $this->db->prepare("
            UPDATE produto_pedido 
            SET quantidade = :quantidade, valor = :valor
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':valor', $valor);
        return $stmt->execute();
    }

    // Remover produto de um pedido
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM produto_pedido WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
