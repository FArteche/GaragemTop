<?php
session_start();
require '../includes/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $senha = $_POST['senha'];

    if (!$email) {
        header('Location: login.php?erro=1');
        exit;
    }

    $stmt = $pdo->prepare('SELECT Id, senha FROM Usuario WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        // Login bem-sucedido
        $_SESSION['user_id'] = $user['Id'];
        header('Location: index.php');
        exit;
    } else {
        // Falha no login
        header('Location: login.php?erro=1');
        exit;
    }
} else {
    // Redireciona se o acesso não for via POST
    header('Location: login.php');
    exit;
}
?>