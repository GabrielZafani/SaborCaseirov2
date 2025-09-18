<?php
namespace App\Models;

use PDO;

class Cliente
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

 
    public function create($nome, $cpf, $celular, $endereco_id)
    {
        $stmt = $this->db->prepare("
            INSERT INTO cliente (nome, cpf, celular, endereco_id) 
            VALUES (:nome, :cpf, :celular, :endereco_id)
        ");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':endereco_id', $endereco_id);
        return $stmt->execute();
    }

   
    public function getAll()
    {
        $sql = "SELECT c.*, e.cep, e.estado, e.municipio, e.bairro, e.rua, e.numero
                FROM cliente c
                LEFT JOIN endereco e ON c.endereco_id = e.id";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 
    public function getById($id)
    {
        $sql = "SELECT c.*, e.cep, e.estado, e.municipio, e.bairro, e.rua, e.numero
                FROM cliente c
                LEFT JOIN endereco e ON c.endereco_id = e.id
                WHERE c.id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

 
    public function update($id, $nome, $cpf, $celular, $endereco_id)
    {
        $stmt = $this->db->prepare("
            UPDATE cliente 
            SET nome = :nome, cpf = :cpf, celular = :celular, endereco_id = :endereco_id
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':endereco_id', $endereco_id);
        return $stmt->execute();
    }

  
    
}
