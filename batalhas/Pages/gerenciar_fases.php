<?php
session_start();
include('../config/database.php');

// Verifica se o usuário é professor, caso contrário, redireciona para o login
if ($_SESSION['tipo_usuario'] != 'professor') {
    header('Location: login.php');
    exit();
}

// Variáveis para mensagens de erro e sucesso
$erro = '';
$sucesso = '';

// Processamento de cadastro de fase
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_fase'])) {
    $nome_fase = $_POST['nome_fase'];
    $descricao_fase = $_POST['descricao_fase'];
    $premio_fase = $_POST['premio_fase'];
    
    // Insere a fase no banco de dados
    $stmt = $conn->prepare("INSERT INTO fases (nome_fase, descricao_fase, premio_fase) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome_fase, $descricao_fase, $premio_fase);
    
    if ($stmt->execute()) {
        $sucesso = 'Fase cadastrada com sucesso!';
    } else {
        $erro = 'Erro ao cadastrar fase, tente novamente.';
    }
}

// Processamento de exclusão de fase
if (isset($_GET['excluir_fase'])) {
    $fase_id = $_GET['excluir_fase'];
    
    $stmt = $conn->prepare("DELETE FROM fases WHERE id = ?");
    $stmt->bind_param("i", $fase_id);
    
    if ($stmt->execute()) {
        $sucesso = 'Fase excluída com sucesso!';
    } else {
        $erro = 'Erro ao excluir fase, tente novamente.';
    }
}

// Busca todas as fases cadastradas
$stmt = $conn->prepare("SELECT * FROM fases");
$stmt->execute();
$fases = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Fases</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Gerenciar Fases</h1>
    </header>

    <div class="container">
        <!-- Exibe mensagem de erro ou sucesso -->
        <?php if ($erro) { ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php } ?>
        <?php if ($sucesso) { ?>
            <p class="sucesso"><?php echo $sucesso; ?></p>
        <?php } ?>

        <!-- Formulário para cadastrar nova fase -->
        <h2>Cadastrar Nova Fase</h2>
        <form action="gerenciar_fases.php" method="POST">
            <label for="nome_fase">Nome da Fase:</label>
            <input type="text" name="nome_fase" id="nome_fase" required>

            <label for="descricao_fase">Descrição da Fase:</label>
            <textarea name="descricao_fase" id="descricao_fase" required></textarea>

            <label for="premio_fase">Prêmio da Fase:</label>
            <input type="text" name="premio_fase" id="premio_fase" required>

            <button type="submit" name="cadastrar_fase">Cadastrar Fase</button>
        </form>

        <h2>Fases Cadastradas</h2>
        <!-- Tabela de fases cadastradas -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome da Fase</th>
                    <th>Descrição</th>
                    <th>Prêmio</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($fase = $fases->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $fase['id']; ?></td>
                        <td><?php echo $fase['nome_fase']; ?></td>
                        <td><?php echo $fase['descricao_fase']; ?></td>
                        <td><?php echo $fase['premio_fase']; ?></td>
                        <td>
                            <a href="gerenciar_fases.php?excluir_fase=<?php echo $fase['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir esta fase?')">Excluir</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
