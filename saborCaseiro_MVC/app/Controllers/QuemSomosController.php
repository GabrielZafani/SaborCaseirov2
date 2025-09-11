<?php
namespace App\Controllers;

class QuemSomosController {

    public function index() {
        // Dados estáticos (sem banco)
        $dados = [
            'titulo' => 'Quem Somos - Sabor Caseiro',
            'texto' => "Somos uma confeitaria dedicada a criar doces deliciosos e artesanais, feitos com amor e ingredientes de alta qualidade. Nosso objetivo é levar sabor e alegria a cada cliente que visita nossa loja ou nos encomenda doces especiais.",
            'imagem' => 'img/imagem-confeiteira.jpg',
            'localizacao' => [
                'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3643.854273981125!2d-52.39428872386942!3d-24.036203478476438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ed751b68fd1bed%3A0x3820d1faf45dff93!2sR.%20Franz%20Kaiser%2C%201124%20-%20Jardim%20Copacabana%2C%20Campo%20Mour%C3%A3o%20-%20PR%2C%2087302-310!5e0!3m2!1spt-PT!2sbr!4v1757612761210!5m2!1spt-PT!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'endereco' => 'Rua Franz Kaiser, 1124 - Jardim Copacabana, Campo Mourão - PR, 87302-310'
            ]
        ];

        // Inclui a view **depois de definir a variável**
        include __DIR__ . '/../Views/quem-somos.phtml';
    }
}
