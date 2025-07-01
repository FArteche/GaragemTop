<?php
include 'includes/header.php';

$id_categoria = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_categoria) {
    echo "<p class='alert alert-danger'>Categoria inválida!</p>";
    include 'includes/footer.php';
    exit;
}

$stmt_cat = $pdo->prepare('SELECT nome FROM Categoria WHERE Id = ?');
$stmt_cat->execute([$id_categoria]);
$categoria = $stmt_cat->fetch();

$stmt = $pdo->prepare('SELECT Id, modelo, marca, ano, imagem FROM Veiculo WHERE id_categoria = ?');
$stmt->execute([$id_categoria]);
$veiculos = $stmt->fetchAll();

?>

<h2 class="mb-4">Veículos da Categoria: <?php echo htmlspecialchars($categoria['nome']); ?></h2>

<div class="row">
    <?php if (count($veiculos) > 0): ?>
        <?php foreach ($veiculos as $veiculo): ?>
            <div class='col-md-4 mb-3'>
                <div class='card'>
                    <img src='uploads/<?php echo htmlspecialchars($veiculo['imagem']); ?>' class='card-img-top' alt='...'>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?></h5>
                        <p class='card-text'>Ano: <?php echo htmlspecialchars($veiculo['ano']); ?></p>
                        <a href='veiculo.php?id=<?php echo $veiculo['Id']; ?>' class='btn btn-primary'>Ver Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="alert alert-info">Nenhum veículo encontrado nesta categoria.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>