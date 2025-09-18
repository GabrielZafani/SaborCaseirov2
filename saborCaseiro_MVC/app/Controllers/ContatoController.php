<?php

namespace App\Controllers;

use App\Core\Controller; // Se você tiver uma classe base Controller
use App\Models\Endereco;
use App\Models\Cliente;
use App\Models\Pedido;
use Exception; // Importa a classe de exceção

class ContatoController extends Controller
{   
      private function view(string $viewName, array $data = [])
    {
        extract($data);
        $viewPath = __DIR__ . "/../Views/{$viewName}.phtml";
        
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "Erro: View '{$viewName}' não encontrada.";
        }
    }
    
    public function index()
    {
        $this->view('contato'); // O método existe na própria classe
    }
    // Este método irá processar a requisição POST do formulário
    public function enviar()
{
    $pdo = require __DIR__ . '/../Core/database.php';

    $enderecoModel = new Endereco($pdo);
    $clienteModel  = new Cliente($pdo);
    $pedidoModel   = new Pedido($pdo);

    // Dados do cliente
    $nome    = $_POST['nome'] ?? '';
    $cpf     = $_POST['cpf'] ?? '';
    $celular = $_POST['celular'] ?? '';

    // Dados do endereço
    $cep       = $_POST['cep'] ?? '';
    $estado    = $_POST['estado'] ?? '';
    $municipio = $_POST['municipio'] ?? '';
    $bairro    = $_POST['bairro'] ?? '';
    $rua       = $_POST['rua'] ?? '';
    $numero    = $_POST['numero'] ?? '';

    // Dados do pedido
    $produto_id = $_POST['produto_id'] ?? 0;
    $quantidade = $_POST['quantidade'] ?? 1;
    $valor      = $_POST['valor'] ?? 0.00;

    try {
        $pdo->beginTransaction();

        // 1. Cria endereço
        $endereco_id = $enderecoModel->create($cep, $estado, $municipio, $bairro, $rua, $numero);
        if (!$endereco_id) {
            throw new Exception("Erro ao inserir o endereço.");
        }

        // 2. Cria cliente
        $cliente_id = $clienteModel->create($nome, $cpf, $celular, $endereco_id);
        if (!$cliente_id) {
            throw new Exception("Erro ao inserir o cliente.");
        }

        // 3. Cria pedido
        $pedido_id = $pedidoModel->create((int)$produto_id, (int)$cliente_id, (int)$quantidade, (float)$valor);
        if (!$pedido_id) {
            throw new Exception("Erro ao inserir o pedido.");
        }

        
        $pdo->commit();

       
        echo "<script>
                alert('Pedido enviado com sucesso!');
                window.location.href = '/saborCaseiro_MVC/public/contato';
              </script>";
        exit;

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        die("Erro ao processar o pedido: " . $e->getMessage());
    }
}
}