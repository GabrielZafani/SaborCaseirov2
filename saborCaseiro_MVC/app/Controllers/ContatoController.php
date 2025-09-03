<?php
namespace App\Controllers;

class ContatoController {
    public function index() {
        require __DIR__ . '/../Views/contato.php';
    }

    // Método para processar envio do formulário (simples)
    public function enviar() {
        // Simplesmente mostra mensagem, você pode depois validar e salvar no DB
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $mensagem = $_POST['mensagem'] ?? '';

        $erros = [];

        if (!$nome) $erros[] = 'O nome é obrigatório.';
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = 'Email inválido.';
        if (!$mensagem) $erros[] = 'Mensagem não pode ser vazia.';

        if (!empty($erros)) {
            require __DIR__ . '/../Views/contato.php';
            return;
        }

        // Aqui você pode salvar no banco, enviar email, etc.

        $sucesso = "Mensagem enviada com sucesso! Entraremos em contato em breve.";
        require __DIR__ . '/../Views/contato.php';
    }
}
