<?php
session_start();
include '../includes/db.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica se os campos do formulário foram preenchidos corretamente
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $senha = isset($_POST['senha']) ? $_POST['senha'] : null;
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : null;

    if ($nome && $email && $senha && $tipo) { // Confirma que todos os dados estão preenchidos
        registerUser($nome, $email, $senha, $tipo);
    } else {
        echo "Por favor, preencha todos os campos corretamente.";
    }
}

function registerUser($nome, $email, $senha, $tipo) {
    global $pdo;

    // Verifica se o e-mail já está cadastrado
    $check_stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
    $check_stmt->execute([$email]);
    
    if ($check_stmt->fetch()) {
        echo "Este e-mail já está cadastrado.";
        return;
    }

    // Criptografa a senha antes de armazená-la no banco
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    // Insere o usuário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$nome, $email, $senha_hash, $tipo])) {
        echo "Registro realizado com sucesso!";
        header("Location: login.php");
        exit();
    } else {
        echo "Erro ao registrar usuário.";
    }
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
        <h1>Registro</h1>

        <form action="register.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>

            <label for="tipo">Tipo de Usuário:</label>
            <select id="tipo" name="tipo" required>
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>

            <button type="submit">Registrar</button>
        </form>

        <a href="login.php">Já tem uma conta? Faça login</a>
    </div>
</body>
</html>
