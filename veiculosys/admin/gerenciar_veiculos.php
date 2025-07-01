<?php
require '../includes/verifica_login.php';
require '../includes/conexao.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'deletar') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        $stmt_img = $pdo->prepare("SELECT imagem FROM Veiculo WHERE Id = ?");
        $stmt_img->execute([$id]);
        $veiculo_img = $stmt_img->fetch();
        if ($veiculo_img && !empty($veiculo_img['imagem']) && file_exists("../uploads/{$veiculo_img['imagem']}")) {
            unlink("../uploads/{$veiculo_img['imagem']}");
        }

        $stmt = $pdo->prepare('DELETE FROM Veiculo WHERE Id = ?');
        $stmt->execute([$id]);

        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Veículo excluído com sucesso!'];
        header('Location: gerenciar_veiculos.php');
        exit;
    }
}

$veiculos = $pdo->query('SELECT v.Id, v.modelo, v.marca, v.ano, c.nome AS categoria_nome FROM Veiculo v JOIN Categoria c ON v.id_categoria = c.Id ORDER BY v.modelo')->fetchAll();
?>

<?php include '../includes/header_admin.php'; ?>

<h2>Gerenciar Veículos</h2>
<a href="form_veiculo.php" class="btn btn-primary mb-3">Adicionar Novo Veículo</a>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Ano</th>
                <th>Categoria</th>
                <th class="text-end">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($veiculos as $veiculo): ?>
            <tr>
                <td><?php echo htmlspecialchars($veiculo['modelo']); ?></td>
                <td><?php echo htmlspecialchars($veiculo['marca']); ?></td>
                <td><?php echo htmlspecialchars($veiculo['ano']); ?></td>
                <td><?php echo htmlspecialchars($veiculo['categoria_nome']); ?></td>
                <td class="text-end">
                    <a href="form_veiculo.php?id=<?php echo $veiculo['Id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    
                    <button type="button" class="btn btn-sm btn-danger" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmDeleteModal"
                            data-delete-url="gerenciar_veiculos.php?acao=deletar&id=<?php echo $veiculo['Id']; ?>"
                            data-item-name="<?php echo htmlspecialchars($veiculo['marca'] . ' ' . $veiculo['modelo']); ?>">
                        Excluir
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer_admin.php'; ?>