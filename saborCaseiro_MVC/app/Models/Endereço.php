<?php
namespace App\Models;

use PDO;

class Endereco
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar endereço
    public function create($cep, $estado, $municipio, $bairro, $rua, $numero)
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
            return $this->db->lastInsertId(); // retorna o ID do endereço criado
        }
        return false;
    }

    // Buscar endereço por ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM endereco WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Listar todos os endereços
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM endereco");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Atualizar endereço
    public function update($id, $cep, $estado, $municipio, $bairro, $rua, $numero)
    {
        $stmt = $this->db->prepare("
            UPDATE endereco 
            SET cep = :cep, estado = :estado, municipio = :municipio, bairro = :bairro, rua = :rua, numero = :numero
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':municipio', $municipio);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);

        return $stmt->execute();
    }

    // Deletar endereço
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM endereco WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
