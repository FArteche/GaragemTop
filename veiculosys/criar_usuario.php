<?php

require 'includes/conexao.php';

$nome = 'Administrador';
$email = 'admin@admin.com';
$senha_texto = '123456';

$senha_hash = password_hash($senha_texto, PASSWORD_DEFAULT);

try {
    $stmt = $pdo->prepare("INSERT INTO Usuario (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha_hash]);
    echo "<h1>Usuário Administrador criado com sucesso!</h1>";
    echo "<p><strong>E-mail:</strong> {$email}</p>";
    echo "<p><strong>Senha:</strong> {$senha_texto}</p>";
    echo "<p style='color:red;'><strong>APAGUE ESTE ARQUIVO AGORA!</strong></p>";
} catch (PDOException $e) {
    if ($e->getCode() == '23000') { 
        echo "<h1>Erro: O e-mail '{$email}' já existe no banco de dados.</h1>";
    } else {
        echo "<h1>Erro ao criar usuário: " . $e->getMessage() . "</h1>";
    }
}
?>