<?php
session_start();
include('config/database.php');

// Verifica se o usuário já está logado, caso esteja, redireciona para o painel
if (isset($_SESSION['usuario_id'])) {
    header('Location: dashboard.php');
    exit();
}

// Variáveis para mensagens de erro e sucesso
$erro = '';
$sucesso = '';

// Processamento do cadastro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografando a senha
    $tipo_usuario = $_POST['tipo_usuario']; // Aluno ou Professor

    // Verifica se o email já existe
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $erro = 'Este e-mail já está cadastrado!';
    } else {
        // Insere o novo usuário no banco de dados
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo_usuario) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha, $tipo_usuario);
        if ($stmt->execute()) {
            $sucesso = 'Cadastro realizado com sucesso! Você pode fazer login agora.';
        } else {
            $erro = 'Erro ao realizar o cadastro, tente novamente.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Cadastro de Usuário</h1>
    </header>

    <div class="container">
        <!-- Exibe mensagem de erro ou sucesso -->
        <?php if ($erro) { ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php } ?>
        <?php if ($sucesso) { ?>
            <p class="sucesso"><?php echo $sucesso; ?></p>
        <?php } ?>

        <!-- Formulário de cadastro -->
        <form action="cadastro.php" method="POST">
            <label for="nome">Nome Completo:</label>
            <input type="text" name="nome" id="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <label for="tipo_usuario">Tipo de Usuário:</label>
            <select name="tipo_usuario" id="tipo_usuario" required>
                <option value="aluno">Aluno</option>
                <option value="professor">Professor</option>
            </select>

            <button type="submit">Cadastrar</button>
        </form>

        <p>Já tem uma conta? <a href="login.php">Faça login aqui</a></p>
    </div>
</body>
</html>
