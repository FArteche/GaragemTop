<?php
require '../includes/verifica_login.php'; 
require '../includes/conexao.php';

if (isset($_GET['acao']) && $_GET['acao'] == 'deletar') {
    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id) {
        try {
            $stmt = $pdo->prepare('DELETE FROM Categoria WHERE Id = ?');
            $stmt->execute([$id]);
            $_SESSION['flash_message'] = [
                'type' => 'success', 
                'message' => 'Categoria excluída com sucesso!'
            ];
        } catch (PDOException $e) {
            $_SESSION['flash_message'] = [
                'type' => 'danger',
                'message' => 'Erro ao excluir categoria. Verifique se há veículos associados.'
            ];
        }
    }
    header('Location: gerenciar_categorias.php');
    exit;
}

$categorias = $pdo->query('SELECT * FROM Categoria ORDER BY nome')->fetchAll();
?>

<?php include '../includes/header_admin.php'; ?>

<h2>Gerenciar Categorias</h2>
<a href="form_categoria.php" class="btn btn-primary mb-3">Adicionar Nova Categoria</a>

<table class="table table-striped table-hover">
    <tbody>
        <?php foreach ($categorias as $categoria): ?>
        <tr>
            <td><?php echo $categoria['Id']; ?></td>
            <td><?php echo htmlspecialchars($categoria['nome']); ?></td>
            <td>
                <a href="form_categoria.php?id=<?php echo $categoria['Id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                
                <button type="button" class="btn btn-sm btn-danger" 
                        data-bs-toggle="modal" 
                        data-bs-target="#confirmDeleteModal"
                        data-delete-url="gerenciar_categorias.php?acao=deletar&id=<?php echo $categoria['Id']; ?>"
                        data-item-name="<?php echo htmlspecialchars($categoria['nome']); ?>">
                    Excluir
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include '../includes/footer_admin.php'; ?>