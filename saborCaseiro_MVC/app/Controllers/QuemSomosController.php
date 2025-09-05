<?php
namespace App\Controllers;

class QuemSomosController {
    public function index() {
        $dados = [
            'titulo' => 'Quem Somos - Sabor Caseiro',
            'texto' => "Bem-vindo à Sabor Caseiro, sua melhor opção para bolos artesanais e deliciosos!
                       Nosso objetivo é proporcionar a melhor experiência em cada fatia, usando ingredientes frescos e receitas caseiras.
                       Peça já o seu bolo e experimente o sabor caseiro!
                       Para mais informações, entre em contato conosco. Estamos aqui para atender você!
                       Telefone: (44) 98411-2718",
            'imagem' => '/img/confeiteira.png',
            'localizacao' => [
                'iframe' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3643.854273981125!2d-52.39428872386942!3d-24.03620347847644!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ed751b68fd1bed%3A0x3820d1faf45dff93!2sR.%20Franz%20Kaiser%2C%201124%20-%20Jardim%20Copacabana%2C%20Campo%20Mour%C3%A3o%20-%20PR%2C%2087302-310!5e0!3m2!1spt-BR!2sbr!4v1750480642489!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
                'endereco' => 'Estamos localizados na Rua Franz Kaiser, 1124 - Jardim Copacabana, Campo Mourão - PR, 87302-310. Venha nos visitar!'
            ]
        ];

        require __DIR__ . '/../Views/quem-somos.phtml';
    }
}
