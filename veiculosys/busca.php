<?php
include 'includes/header.php';

$termo_modelo = filter_input(INPUT_GET, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS);
$termo_ano = filter_input(INPUT_GET, 'ano', FILTER_VALIDATE_INT);

$sql = "SELECT Id, modelo, marca, ano, imagem FROM Veiculo WHERE 1=1";
$params = [];
$titulo_busca = "Resultados da Busca";

if ($termo_modelo) {
    $sql .= " AND modelo LIKE ?";
    $params[] = "%" . $termo_modelo . "%";
    $titulo_busca .= " por modelo '{$termo_modelo}'";
}

if ($termo_ano) {
    $sql .= " AND ano = ?";
    $params[] = $termo_ano;
    $titulo_busca .= " por ano '{$termo_ano}'";
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$veiculos = $stmt->fetchAll();

?>

<h2 class="mb-4"><?php echo htmlspecialchars($titulo_busca); ?></h2>

<div class="row">
    <?php if (count($veiculos) > 0): ?>
        <?php foreach ($veiculos as $veiculo): ?>
            <div class='col-md-4 mb-3'>
                <div class='card'>
                    <img src='uploads/<?php echo htmlspecialchars($veiculo['imagem']); ?>' class='card-img-top' alt='...' style='height: 200px; object-fit: cover;'>
                    <div class='card-body'>
                        <h5 class='card-title'><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?></h5>
                        <p class='card-text'>Ano: <?php echo htmlspecialchars($veiculo['ano']); ?></p>
                        <a href='veiculo.php?id=<?php echo $veiculo['Id']; ?>' class='btn btn-primary'>Ver Detalhes</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="alert alert-info">Nenhum veículo encontrado com os critérios da sua busca.</p>
    <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>