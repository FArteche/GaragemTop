<?php
require '../includes/verifica_login.php';
require '../includes/conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$veiculo = []; 
$titulo = "Adicionar Novo Veículo";


$categorias = $pdo->query("SELECT Id, nome FROM Categoria ORDER BY nome")->fetchAll();

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM Veiculo WHERE Id = ?");
    $stmt->execute([$id]);
    $veiculo = $stmt->fetch();
    if (!$veiculo) {
        die("Veículo não encontrado.");
    }
    $titulo = "Editar Veículo";
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_post = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_VALIDATE_INT);
    $modelo = filter_input(INPUT_POST, 'modelo', FILTER_SANITIZE_SPECIAL_CHARS);
    $marca = filter_input(INPUT_POST, 'marca', FILTER_SANITIZE_SPECIAL_CHARS);
    $placa = filter_input(INPUT_POST, 'placa', FILTER_SANITIZE_SPECIAL_CHARS);
    $cor = filter_input(INPUT_POST, 'cor', FILTER_SANITIZE_SPECIAL_CHARS);
    $ano = filter_input(INPUT_POST, 'ano', FILTER_VALIDATE_INT);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);
    
    $imagem_atual = $_POST['imagem_atual'];
    $imagem_nome = $imagem_atual; 

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
        $upload_dir = '../uploads/';
        $imagem_nome = uniqid() . '_' . basename($_FILES['imagem']['name']);
        $caminho_imagem = $upload_dir . $imagem_nome;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho_imagem)) {
            if ($imagem_atual && file_exists($upload_dir . $imagem_atual)) {
                unlink($upload_dir . $imagem_atual);
            }
        } else {
            $imagem_nome = $imagem_atual;
        }
    }

    if ($id_post) { // Atualizar
        $sql = "UPDATE Veiculo SET id_categoria=?, placa=?, modelo=?, marca=?, cor=?, ano=?, imagem=?, descricao=? WHERE Id=?";
        $params = [$id_categoria, $placa, $modelo, $marca, $cor, $ano, $imagem_nome, $descricao, $id_post];
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Veículo atualizado com sucesso!'];
    } else { // Inserir
        $sql = "INSERT INTO Veiculo (id_categoria, placa, modelo, marca, cor, ano, imagem, descricao) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $params = [$id_categoria, $placa, $modelo, $marca, $cor, $ano, $imagem_nome, $descricao];
        $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Veículo cadastrado com sucesso!'];
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    header("Location: gerenciar_veiculos.php");
    exit;
}
?>
<?php include '../includes/header_admin.php'; ?>

<h2><?php echo $titulo; ?></h2>

<form method="POST" enctype="multipart/form-data">
    <?php if ($id): ?>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="imagem_atual" value="<?php echo htmlspecialchars($veiculo['imagem'] ?? ''); ?>">
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" value="<?php echo htmlspecialchars($veiculo['modelo'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" value="<?php echo htmlspecialchars($veiculo['marca'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="placa" class="form-label">Placa</label>
                <input type="text" class="form-control" id="placa" name="placa" value="<?php echo htmlspecialchars($veiculo['placa'] ?? ''); ?>">
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="ano" class="form-label">Ano</label>
                <input type="number" class="form-control" id="ano" name="ano" value="<?php echo htmlspecialchars($veiculo['ano'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="cor" class="form-label">Cor</label>
                <input type="text" class="form-control" id="cor" name="cor" value="<?php echo htmlspecialchars($veiculo['cor'] ?? ''); ?>">
            </div>
            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoria</label>
                <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['Id']; ?>" <?php echo (isset($veiculo['id_categoria']) && $veiculo['id_categoria'] == $cat['Id']) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    
    <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea class="form-control" id="descricao" name="descricao" rows="3"><?php echo htmlspecialchars($veiculo['descricao'] ?? ''); ?></textarea>
    </div>

    <div class="mb-3">
        <label for="imagem" class="form-label">Imagem do Veículo</label>
        <input class="form-control" type="file" id="imagem" name="imagem" accept="image/*">
        <?php if (isset($veiculo['imagem']) && $veiculo['imagem']): ?>
            <div class="mt-2">
                <p>Imagem atual:</p>
                <img src="../uploads/<?php echo htmlspecialchars($veiculo['imagem']); ?>" alt="Imagem atual" style="max-width: 200px; height: auto;">
            </div>
        <?php endif; ?>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Veículo</button>
    <a href="gerenciar_veiculos.php" class="btn btn-secondary">Cancelar</a>
</form>

<?php include '../includes/footer_admin.php'; ?>