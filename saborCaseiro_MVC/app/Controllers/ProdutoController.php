<?php
namespace App\Controllers;

class ProdutoController {
    private $produtos = [];

    public function __construct() {
        // Conexão com o banco
        $host = "localhost";
        $usuario = "root";       
        $senha = "";             
        $banco = "projeto";       

        $conn = new \mysqli($host, $usuario, $senha, $banco);

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        // Consulta todos os produtos
        $sql = "SELECT * FROM produtos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->produtos[$row['id']] = [
                    'nome' => $row['nome'],
                    'valor' => $row['preco'],
                    'foto' => $row['foto'],
                    'descricao' => $row['descricao'],
                    'destaque' => $row['destaque'] ? true : false,
                ];
            }
        }

        $conn->close();
    }

    public function show($id) {
        if (!isset($this->produtos[$id])) {
            http_response_code(404);
            echo "<h1>Produto não encontrado</h1>";
            return;
        }

        $produto = $this->produtos[$id];

        // Produtos em destaque, exceto o atual
        $produtosDestaque = array_filter($this->produtos, function($p, $key) use ($id) {
            return !empty($p['destaque']) && $key != $id;
        }, ARRAY_FILTER_USE_BOTH);

        require __DIR__ . '/../Views/produto.php';
    }

    // Função para retornar todos os produtos (para o catálogo)
    public function all() {
        return $this->produtos;
    }
}
