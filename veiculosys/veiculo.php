<?php
include 'includes/header.php';

$id_veiculo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_veiculo) {
    echo "<div class='alert alert-danger'>Veículo inválido!</div>";
    include 'includes/footer.php';
    exit;
}


$stmt = $pdo->prepare('SELECT v.*, c.nome as nome_categoria FROM Veiculo v JOIN Categoria c ON v.id_categoria = c.Id WHERE v.Id = ?');
$stmt->execute([$id_veiculo]);
$veiculo = $stmt->fetch();

if (!$veiculo) {
     echo "<div class='alert alert-danger'>Veículo não encontrado!</div>";
     include 'includes/footer.php';
     exit;
}
?>

<div class="row g-5">
    <div class="col-lg-7">
        <img src="uploads/<?php echo htmlspecialchars($veiculo['imagem']); ?>" class="img-fluid rounded shadow-sm w-100" alt="<?php echo htmlspecialchars($veiculo['modelo']); ?>">
    </div>
    <div class="col-lg-5">
        <h1 class="mb-3"><?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?></h1>
        <ul class="list-group list-group-flush fs-5">
            <li class="list-group-item px-0"><strong>Ano:</strong> <?php echo htmlspecialchars($veiculo['ano']); ?></li>
            <li class="list-group-item px-0"><strong>Cor:</strong> <?php echo htmlspecialchars($veiculo['cor']); ?></li>
            <li class="list-group-item px-0"><strong>Placa:</strong> <?php echo htmlspecialchars($veiculo['placa']); ?></li>
            <li class="list-group-item px-0"><strong>Categoria:</strong> <?php echo htmlspecialchars($veiculo['nome_categoria']); ?></li>
        </ul>
        <div class="mt-4">
            <h4>Descrição</h4>
            <p><?php echo nl2br(htmlspecialchars($veiculo['descricao'])); ?></p>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>