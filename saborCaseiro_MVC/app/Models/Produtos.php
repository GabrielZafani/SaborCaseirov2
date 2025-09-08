<?php
namespace App\Models;

use PDO;
use PDOException;

class Produto   // mantém singular, igual já está
{
    private $db;

    public function __construct()
    {
        try {
            $host = "localhost";
            $dbname = "projeto";  // ajuste se o teu banco tiver outro nome
            $user = "root";
            $pass = "";

            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

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

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM produto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM produto WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nome, $valor, $descricao, $imagem, $peso)
    {
        $stmt = $this->db->prepare("
            UPDATE produto 
            SET nome = :nome, valor = :valor, descricao = :descricao, imagem = :imagem, peso = :peso
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':valor', $valor);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':imagem', $imagem);
        $stmt->bindParam(':peso', $peso);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM produto WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getDestaques($limit = 3)
    {
        $stmt = $this->db->prepare("SELECT * FROM produto LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
