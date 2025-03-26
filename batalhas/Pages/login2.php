<?php
require_once '../config/auth.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (login($email, $senha)) {
        header("Location: ../pages/dashboard.php");
        exit();
    } else {
        $erro = "E-mail ou senha incorretos!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <form method="post">
        <h2>Login</h2>
        <?php if (isset($erro)) echo "<p>$erro</p>"; ?>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
