<?php
namespace App\Controllers;

class ContatoController {
    public function index() {
        // Adiciona máscaras via JavaScript no formulário
        include __DIR__ . '/../Views/contato.phtml';
        echo <<<JS
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(function(){
    $('[name="cpf"]').mask('000.000.000-00');
    $('[name="celular"]').mask('(00) 00000-0000');
    $('[name="cep"]').mask('00000-000');
    // Adicione outras máscaras conforme necessário
});
</script>
JS;
    }

    public function enviar() {
        // 1. Captura os dados do formulário
        $nome     = $_POST['nome'];
        $cpf      = $_POST['cpf'];
        $celular  = $_POST['celular'];

        $cep      = $_POST['cep'];
        $estado   = $_POST['estado'];
        $municipio= $_POST['municipio'];
        $bairro   = $_POST['bairro'];
        $rua      = $_POST['rua'];
        $numero   = $_POST['numero'];

        // 2. Conecta ao banco de dados
        $conn = new \mysqli("localhost", "root", "", "projeto");

        if ($conn->connect_error) {
            die("Erro de conexão: " . $conn->connect_error);
        }

        // 3. Inicia uma transação
        $conn->begin_transaction();

        try {
            // 4. Insere o endereço primeiro
            $stmt1 = $conn->prepare("INSERT INTO endereco (cep, estado, municipio, bairro, rua, numero) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt1->bind_param("ssssss", $cep, $estado, $municipio, $bairro, $rua, $numero);
            $stmt1->execute();

            // 5. Pega o ID do endereço recém inserido
            $endereco_id = $conn->insert_id;

            // 6. Insere o cliente com o endereco_id
            $stmt2 = $conn->prepare("INSERT INTO cliente (nome, cpf, celular, endereco_id) VALUES (?, ?, ?, ?)");
            $stmt2->bind_param("sssi", $nome, $cpf, $celular, $endereco_id);
            $stmt2->execute();

            // 7. Finaliza a transação
            $conn->commit();

            // 8. Feedback ao usuário
            echo "<p>Cliente e endereço cadastrados com sucesso!</p>";

        } catch (\Exception $e) {
            $conn->rollback();
            echo "<p>Erro ao salvar os dados: " . $e->getMessage() . "</p>";
        }

        // 9. Fecha a conexão
        $conn->close();
    }
}
