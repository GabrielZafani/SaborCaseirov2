<?php
namespace App\Core;

class Controller {
    protected function render($view, $data = []) {
        extract($data);

        $viewFile = __DIR__ . "/../Views/{$view}.phtml";
        if (file_exists($viewFile)) {
            include __DIR__ . "/../Views/header.phtml";
            include $viewFile;
            include __DIR__ . "/../Views/footer.phtml";
        } else {
            echo "View {$view} não encontrada!";
        }
    }
}
