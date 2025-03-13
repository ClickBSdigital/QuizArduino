<?php
session_start(); // Inicia a sessão
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];  // Pegando o campo correto do formulário
    $senha = $_POST['senha'];
    login($email, $senha);
}

function login($email, $senha) {
    global $pdo;

    // Corrigindo a consulta para usar 'email' ao invés de 'usuario'
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) { // Verifica senha com hash
        $_SESSION['user'] = $user;
        header('Location: index.php');
        exit();
    } else {
        echo "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Login</h1>

        <form action="login.php" method="POST">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <button type="submit">Entrar</button>
        </form>

        <a href="register.php">Não tem uma conta? Registre-se aqui</a>
    </div>
</body>
</html>
