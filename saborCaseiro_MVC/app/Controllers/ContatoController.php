<?php
namespace App\Controllers;

use App\Core\Controller;
use PDO;

class ContatoController extends Controller
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=projeto;charset=utf8", "root", "");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die("Erro de conexão: " . $e->getMessage());
        }
    }

   

    public function index()
    {
        include __DIR__ . '/../Views/contato.phtml';
        echo <<<JS
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(function(){
    $('[name="cpf"]').mask('000.000.000-00');
    $('[name="celular"]').mask('(00) 00000-0000');
    $('[name="cep"]').mask('00000-000');
});
</script>
JS;
    }

    public function enviar()
    {
        $nome      = $_POST['nome'] ?? '';
        $cpf       = $_POST['cpf'] ?? '';
        $celular   = $_POST['celular'] ?? '';
        $cep       = $_POST['cep'] ?? '';
        $estado    = $_POST['estado'] ?? '';
        $municipio = $_POST['municipio'] ?? '';
        $bairro    = $_POST['bairro'] ?? '';
        $rua       = $_POST['rua'] ?? '';
        $numero    = $_POST['numero'] ?? '';

        try {
            // Inicia transação
            $this->db->beginTransaction();

            // Insere endereço
            $stmt1 = $this->db->prepare(
                "INSERT INTO endereco (cep, estado, municipio, bairro, rua, numero) 
                 VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt1->execute([$cep, $estado, $municipio, $bairro, $rua, $numero]);

            $endereco_id = $this->db->lastInsertId();

            // Insere cliente vinculado ao endereço
            $stmt2 = $this->db->prepare(
                "INSERT INTO cliente (nome, cpf, celular, endereco_id) 
                 VALUES (?, ?, ?, ?)"
            );
            $stmt2->execute([$nome, $cpf, $celular, $endereco_id]);

            
          
           
$this->db->commit();

echo "<script>
    alert('✅ Cliente cadastrado com sucesso!');
    window.location.href = '/saborCaseiro_MVC/public/contato';
</script>";
} catch (\PDOException $e) {
    $this->db->rollBack();
    echo "<script>
        alert('❌ Erro ao salvar os dados: " . addslashes($e->getMessage()) . "');
        window.location.href = '/saborCaseiro_MVC/public/contato';
    </script>";
}



    }

}
