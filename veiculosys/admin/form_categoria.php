<?php
require '../includes/verifica_login.php';
require '../includes/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$categoria = ['nome' => ''];
$titulo = "Adicionar Nova Categoria";

if ($id) {
    $titulo = "Editar Categoria";
    $stmt = $pdo->prepare("SELECT * FROM Categoria WHERE Id = ?");
    $stmt->execute([$id]);
    $categoria = $stmt->fetch();
    if (!$categoria) { die("Categoria não encontrada."); }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $id_post = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($nome) {
        if ($id_post) { // Atualizar
            $stmt = $pdo->prepare("UPDATE Categoria SET nome = ? WHERE Id = ?");
            $stmt->execute([$nome, $id_post]);
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Categoria atualizada com sucesso!'];
        } else { // Inserir
            $stmt = $pdo->prepare("INSERT INTO Categoria (nome) VALUES (?)");
            $stmt->execute([$nome]);
            $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Categoria cadastrada com sucesso!'];
        }
        header("Location: gerenciar_categorias.php");
        exit;
    }
}
?>
<?php include '../includes/header_admin.php'; ?>

<h2><?php echo $titulo; ?></h2>

<form method="POST" class="mt-4">
    <?php if ($id): ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
    <?php endif; ?>

    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($categoria['nome']); ?>" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="gerenciar_categorias.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include '../includes/footer_admin.php'; ?>