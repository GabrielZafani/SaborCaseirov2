<?php
namespace App\Models;

use PDO;

class Produto {
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host=localhost;dbname=projeto;charset=utf8";
        $user = "root"; 
        $pass = "";

        try {
            $this->pdo = new PDO($dsn, $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM produto");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM produto WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
