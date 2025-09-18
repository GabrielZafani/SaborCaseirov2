<?php

namespace App\Controllers;

class NotFoundController
{
    public function index()
    {
        http_response_code(404);
        echo "<h1>404 - Página não encontrada</h1>";
    }
}
