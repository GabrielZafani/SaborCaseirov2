<?php
namespace App\Models;

use PDO;

class Pedido
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar pedido
    public function create($cliente_id, $descricao, $data, $status)
    {
        $stmt = $this->db->prepare("
            INSERT INTO pedido (cliente_id, descricao, data, status)
            VALUES (:cliente_id, :descricao, :data, :status)
        ");
        $stmt->bindParam(':cliente_id', $cliente_id);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            return $this->db->lastInsertId(); // retorna o ID do pedido criado
        }
        return false;
    }

    // Buscar pedido por ID
    public function getById($id)
    {
        $sql = "SELECT p.*, c.nome as cliente_nome, c.cpf, c.celular
                FROM pedido p
                LEFT JOIN cliente c ON p.cliente_id = c.id
                WHERE p.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todos os pedidos
    public function getAll()
    {
        $sql = "SELECT p.*, c.nome as cliente_nome
                FROM pedido p
                LEFT JOIN cliente c ON p.cliente_id = c.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar pedido
    public function update($id, $descricao, $data, $status)
    {
        $stmt = $this->db->prepare("
            UPDATE pedido 
            SET descricao = :descricao, data = :data, status = :status
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':status', $status);
        return $stmt->execute();
    }

    // Deletar pedido
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM pedido WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
