<?php
namespace App\Models;

class Produto
{
    private $produtos = [];

    public function __construct()
    {
        // simulando um "array.php"
        $this->produtos = [
            1 => [
                'nome' => 'Bolo de Chocolate',
                'valor' => 45.50,
                'foto' => 'bolo-chocolate.jpg',
            ],
            2 => [
                'nome' => 'Bolo de Cenoura',
                'valor' => 39.90,
                'foto' => 'bolo-cenoura.jpg',
            ],
            3 => [
                'nome' => 'Bolo Red Velvet',
                'valor' => 59.00,
                'foto' => 'bolo-red-velvet.jpg',
            ],
        ];
    }

    public function getAll()
    {
        return $this->produtos;
    }

    public function getById($id)
    {
        return $this->produtos[$id] ?? null;
    }
}
