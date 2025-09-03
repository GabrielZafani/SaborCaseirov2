<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($dados['titulo']) ?></title>
    <style>
        /* Seu CSS responsivo que já me enviou */
        /* ... (igual anterior) */
    </style>
</head>
<body>
<section class="quem-somos">
    <div class="quem-somos-texto">
        <h2>Quem Somos</h2>
        <p><?= nl2br(htmlspecialchars($dados['texto'])) ?></p>
    </div>
    <img src="<?= htmlspecialchars($dados['imagem']) ?>" alt="Confeiteira">
</section>

<section class="localizacao">
    <?= $dados['localizacao']['iframe'] ?>
    <div class="localizacao-texto">
        <h2>Localização</h2>
        <p><?= htmlspecialchars($dados['localizacao']['endereco']) ?></p>
    </div>
</section>
</body>
</html>
