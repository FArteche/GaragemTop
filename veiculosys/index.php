<?php include 'includes/header.php'; ?>

<div class="p-5 mb-4 bg-light rounded-3 text-center">
  <div class="container-fluid py-5">
    <h1 class="display-5 fw-bold">Bem-vindo à Garagem Top</h1>
    <p class="col-lg-8 mx-auto fs-4">Navegue pelas categorias em nosso menu ou utilize a busca para encontrar o veículo dos seus sonhos.</p>
  </div>
</div>

<h2 class="mb-4 text-center">Veículos em Destaque</h2>
<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
    <?php

        $stmt = $pdo->query('SELECT Id, modelo, marca, ano, imagem FROM Veiculo ORDER BY data_cadastro DESC LIMIT 6');
        while ($veiculo = $stmt->fetch()):
    ?>
        <div class='col'>
            <div class='card h-100'>
                <div class="card-img-container">
                    <img src='uploads/<?php echo htmlspecialchars($veiculo['imagem']); ?>' class='card-img-top' alt='<?php echo htmlspecialchars($veiculo['modelo']); ?>'>
                </div>
                <div class='card-body'>
                    <h5 class='card-title'><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?></h5>
                    <p class='card-text'>Ano: <?php echo htmlspecialchars($veiculo['ano']); ?></p>
                </div>
                <div class="card-footer bg-transparent border-0 pb-3">
                     <a href='veiculo.php?id=<?php echo $veiculo['Id']; ?>' class='btn btn-primary w-100'>Ver Detalhes</a>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php include 'includes/footer.php'; ?>