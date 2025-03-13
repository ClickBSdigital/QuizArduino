<?php
session_start();
include_once("config/db.php"); // Conexão com o banco de dados

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    // Caso não esteja logado, redirecionar para a página de login
    header("Location: pages/login.php");
    exit();
}

// Definindo o tipo de usuário (aluno ou professor)
$usuario_tipo = $_SESSION['usuario_tipo']; // Tipo de usuário armazenado na sessão

// Lógica para logout
if (isset($_GET['logout'])) {
    session_destroy(); // Destruir a sessão
    header("Location: index.php"); // Redirecionar para a página inicial
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Quiz</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Quiz</h1>
        <nav>
            <ul>
                <li><a href="index.php">Início</a></li>
                <?php if ($usuario_tipo == 'professor'): ?>
                    <li><a href="time.php">Times</a></li>
                    <li><a href="quiz.php">Quiz</a></li>
                    <li><a href="relatorio.php">Relatórios</a></li>
                    <li><a href="perguntas_erradas.php">Perguntas Erradas</a></li>
                <?php endif; ?>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Início</h2>
        <p>Olá, <?php echo $_SESSION['usuario_nome']; ?>! Você está logado como <?php echo $usuario_tipo; ?>.</p>
        
        <!-- Exibir informações específicas para o tipo de usuário -->
        <?php if ($usuario_tipo == 'professor'): ?>
            <p>Você pode gerenciar quizzes, times e visualizar relatórios.</p>
        <?php else: ?>
            <p>Você pode responder aos quizzes e visualizar suas respostas erradas.</p>
        <?php endif; ?>

        <p><a href="logout.php">Clique aqui para fazer logout</a></p>
    </main>

    <footer>
        <p>&copy; 2025 Sistema de Quiz. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
