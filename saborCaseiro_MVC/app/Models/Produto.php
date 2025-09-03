<?php
namespace App\Models;

class Produto {
    public $nome;
    public $preco;
    public $imagem;

    public function __construct($nome, $preco, $imagem) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->imagem = $imagem;
    }

    public static function listarTodos() {
        return [
            new Produto("Bolo de Abacaxi", 35.00, "img/bolo-abacaxi.webp"),
            new Produto("Bolo de Brigadeiro", 45.00, "img/bolo-brigadeiro.jpg"),
            new Produto("Bolo de Cenoura", 30.00, "img/bolo-cenoura.jpg"),
            new Produto("Bolo de Chocolate", 40.00, "img/bolo-chocolate.jpg"),
        ];
    }
}
