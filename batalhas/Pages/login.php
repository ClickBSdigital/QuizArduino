<?php
session_start();
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $sql = "SELECT * FROM usuarios WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario["senha"])) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_tipo"] = $usuario["tipo"];
            
            if ($usuario["tipo"] == "professor") {
                header("Location: painel_admin.php");
            } else {
                header("Location: painel_estudante.php");
            }
            exit;
        }
    }
    echo "Usuário ou senha inválidos!";
}
?>

<form method="POST">
    <input type="email" name="email" placeholder="E-mail" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
