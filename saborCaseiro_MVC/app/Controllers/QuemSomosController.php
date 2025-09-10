<?php
namespace App\Controllers;

class QuemSomosController {
     public function render(): void {
        require __DIR__ . '/../Views/quem-somos.phtml';
    }
    public function index() {
        include __DIR__ . '/../Views/quem-somos.phtml';
    }

   
}
