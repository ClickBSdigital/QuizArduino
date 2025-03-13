<?php
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    updateUser($id, $nome, $email, $senha);
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];
$user = getUserById($id);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Usuário</h1>
        <form action="edit_user.php" method="POST">
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?= $user['nome'] ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $user['email'] ?>" required>
            
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Atualizar</button>
        </form>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
