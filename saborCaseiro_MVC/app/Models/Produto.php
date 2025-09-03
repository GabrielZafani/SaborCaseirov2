<?php
namespace App\Models;

use PDO;

class Produto
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // Criar produto
    public function create($nome, $valor, $descricao, $imagem, $peso)
    {
        $stmt = $this->db->prepare("
            INSERT INTO produto (nome, valor, descricao, imagem, peso) 
            VALUES (:nome, :valor, :descricao, :imagem, :peso)
        ");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':peso', $peso);
        return $stmt->execute();
    }

    // Listar todos os produtos
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM produto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar produto por ID
    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM produto WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualizar produto
    public function update($id, $nome, $valor, $descricao, $imagem, $peso)
    {
        $stmt = $this->db->prepare("
            UPDATE produto 
            SET nome = :nome, valor = :valor, descricao = :descricao, imagem = :imagem, peso = :peso
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':peso', $peso);
        return $stmt->execute();
    }

    // Deletar produto
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM produto WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
