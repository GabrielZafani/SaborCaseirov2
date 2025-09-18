<?php

namespace App\Models;

use PDO;

class Endereco
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    
    /**
     * Insere um novo endereço no banco de dados.
     * @param string $cep
     * @param string $estado
     * @param string $municipio
     * @param string $bairro
     * @param string $rua
     * @param string $numero
     * @return int|false Retorna o ID do novo endereço ou false em caso de falha.
     */
    public function create(string $cep, string $estado, string $municipio, string $bairro, string $rua, string $numero)
    {
        $stmt = $this->db->prepare("
            INSERT INTO endereco (cep, estado, municipio, bairro, rua, numero) 
            VALUES (:cep, :estado, :municipio, :bairro, :rua, :numero)
        ");
        
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':municipio', $municipio);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        
        if ($stmt->execute()) {
            return (int) $this->db->lastInsertId();
        }
        return false;
    }
}