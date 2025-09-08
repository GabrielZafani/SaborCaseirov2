<?php
namespace App\Controllers;

class ContatoController {
    public function index() {
        include __DIR__ . '/../Views/contato.phtml';
    }

    public function enviar() {
        // Aqui você pode processar o formulário
        echo "<p>Mensagem enviada com sucesso!</p>";
    }
}
