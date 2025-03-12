<?php
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];
    registerUser($usuario, $senha, $tipo_usuario);
}

function registerUser($usuario, $senha, $tipo_usuario) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO usuarios (usuario, senha, tipo_usuario) VALUES (?, ?, ?)");
    $stmt->execute([$usuario, $senha, $tipo_usuario]);
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Registrar Novo Usuário</h1>

        <form action="register.php" method="POST">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="tipo_usuario">Tipo de Usuário:</label>
            <select id="tipo_usuario" name="tipo_usuario">
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>

            <button type="submit">Registrar</button>
        </form>

        <a href="login.php">Já tem uma conta? Faça login aqui</a>
    </div>
</body>
</html>
