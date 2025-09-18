<?php

namespace App\Models;

use PDO;

class Pedido
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * 
     *
     * @param int $produto_id
     * @param int $cliente_id
     * @param int $quantidade
     * @param float $valor
     * @return bool
     */
    public function criarPedido(int $produto_id, int $cliente_id, int $quantidade, float $valor): bool
    {
        try {
            $sql = "INSERT INTO pedido (produto_id, cliente_id, quantidade, valor)
                    VALUES (?, ?, ?, ?)";
            
            $stmt = $this->pdo->prepare($sql);
            
            return $stmt->execute([$produto_id, $cliente_id, $quantidade, $valor]);
            
        } catch (\PDOException $e) {
           
            error_log("Erro ao criar pedido: " . $e->getMessage());
            return false;
        }
    }
}