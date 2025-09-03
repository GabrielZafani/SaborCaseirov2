<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($produto['nome']) ?></title>
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-4" style="font-size: 40px; font-weight: bold; font-family: 'Times New Roman', serif;">
            <?= htmlspecialchars($produto['nome']) ?>
        </h2>

        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <img src="/img/<?= htmlspecialchars($produto['foto']) ?>" alt="<?= htmlspecialchars($produto['nome']) ?>" style="width: 100%; max-height: 400px; object-fit: cover; border-radius: 15px;">
            </div>
            <div class="col-md-6">
                <p style="font-size: 1.2rem; line-height: 1.4; margin-top: 1rem;">
                    <?= nl2br(htmlspecialchars($produto['descricao'])) ?>
                </p>
                <p class="mt-4" style="font-weight: bold; font-size: 1.5rem; color: #dc3545;">
                    Valor: R$ <?= number_format($produto['valor'], 2, ',', '.') ?>
                </p>
                <a href="/contato" class="btn btn-danger mt-3">Faça sua encomenda</a>
            </div>
        </div>

        <?php if (!empty($produtosDestaque)): ?>
            <h3 class="mb-4">Outros bolos em destaque</h3>
            <div class="row">
                <?php foreach ($produtosDestaque as $p): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="/img/<?= htmlspecialchars($p['foto']) ?>" alt="<?= htmlspecialchars($p['nome']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($p['nome']) ?></h5>
                            <p class="card-text"><strong>R$ <?= number_format($p['valor'], 2, ',', '.') ?></strong></p>
                            <a href="/produto/<?= array_search($p, $produtosDestaque) ?>" class="btn btn-danger">Encomendar</a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
