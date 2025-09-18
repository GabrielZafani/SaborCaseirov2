<?php

namespace App\Models;

use PDO;

class Pedido
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    /**
     * 
     * 
     * @param int $produto_id
     * @param int $cliente_id
     * @param int $quantidade
     * @param float $valor
     * @return int|false 
     */
    public function create(int $produto_id, int $cliente_id, int $quantidade, float $valor)
    {
        $stmt = $this->db->prepare("
            INSERT INTO pedido (produto_id, cliente_id, quantidade, valor)
            VALUES (:produto_id, :cliente_id, :quantidade, :valor)
        ");

        $stmt->bindParam(':produto_id', $produto_id, PDO::PARAM_INT);
        $stmt->bindParam(':cliente_id', $cliente_id, PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':valor', $valor);

        if ($stmt->execute()) {
            return (int) $this->db->lastInsertId();
        }

        return false;
    }
}
