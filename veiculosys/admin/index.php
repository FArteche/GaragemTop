<?php
require '../includes/verifica_login.php';
require '../includes/conexao.php';

$total_veiculos = $pdo->query('SELECT COUNT(Id) FROM Veiculo')->fetchColumn();
$total_categorias = $pdo->query('SELECT COUNT(Id) FROM Categoria')->fetchColumn();
?>
<?php include '../includes/header_admin.php'; ?>

<div class="container-fluid">
    <h1 class="mt-4">Dashboard</h1>
    <p>Bem-vindo à área administrativa do seu sistema.</p>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <h4>Veículos Cadastrados</h4>
                    <span class="h2"><?php echo $total_veiculos; ?></span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="gerenciar_veiculos.php">Ver Detalhes</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <h4>Categorias</h4>
                    <span class="h2"><?php echo $total_categorias; ?></span>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="gerenciar_categorias.php">Ver Detalhes</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer_admin.php';  ?>