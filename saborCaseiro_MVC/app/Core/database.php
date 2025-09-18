<?php

// database.php

$host = 'localhost'; 
$dbname = 'projeto'; 
$user = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    // Em produção, você pode redirecionar para uma página de erro
    die("Erro de conexão: " . $e->getMessage());
}

return $pdo;

?>