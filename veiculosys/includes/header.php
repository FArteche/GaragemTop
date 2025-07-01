<?php
session_start(); 
require_once 'conexao.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garagem Top</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="toast-container">
    <?php if (isset($_SESSION['flash_message'])): ?>
        <div id="notificationToast" class="toast align-items-center text-bg-<?php echo $_SESSION['flash_message']['type']; ?> border-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <?php echo $_SESSION['flash_message']['message']; ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        <?php unset($_SESSION['flash_message']); // Limpa a mensagem depois de exibir para não aparecer de novo ?>
    <?php endif; ?>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Garagem Top</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
            Categorias
          </a>
          <ul class="dropdown-menu">
            <?php
              $stmt = $pdo->query('SELECT Id, nome FROM Categoria ORDER BY nome');
              while ($categoria = $stmt->fetch()) {
                echo "<li><a class='dropdown-item' href='categoria.php?id={$categoria['Id']}'>{$categoria['nome']}</a></li>";
              }
            ?>
          </ul>
        </li>
      </ul>
      <form class="d-flex mx-2" action="busca.php" method="get">
        <input class="form-control me-2" type="search" name="modelo" placeholder="Buscar por modelo...">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>
      <form class="d-flex" action="busca.php" method="get">
        <input class="form-control me-2" type="number" name="ano" placeholder="Buscar por ano...">
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

<main class="container" style="margin-top: 80px;"> 

