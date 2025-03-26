<?php
session_start();
include('config/database.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

// Cadastrar um evento
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar_evento'])) {
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];
    $descricao_evento = $_POST['descricao_evento'];

    $stmt = $conn->prepare("INSERT INTO eventos (nome, data, descricao) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome_evento, $data_evento, $descricao_evento);
    $stmt->execute();
    $stmt->close();

    echo "Evento cadastrado com sucesso!";
}

// Buscar eventos existentes
$sql = "SELECT * FROM eventos ORDER BY data DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Eventos</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Gerenciar Eventos</h1>
    </header>

    <div class="container">
        <!-- Formulário para cadastrar evento -->
        <form action="gerenciar_eventos.php" method="POST">
            <h2>Cadastrar Evento</h2>
            <label for="nome_evento">Nome do Evento:</label>
            <input type="text" name="nome_evento" id="nome_evento" required>

            <label for="data_evento">Data do Evento:</label>
            <input type="date" name="data_evento" id="data_evento" required>

            <label for="descricao_evento">Descrição do Evento:</label>
            <textarea name="descricao_evento" id="descricao_evento" required></textarea>

            <button type="submit" name="cadastrar_evento">Cadastrar Evento</button>
        </form>

        <!-- Lista de eventos cadastrados -->
        <h2>Eventos Cadastrados</h2>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <thead>
                    <tr>
                        <th>Nome do Evento</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['nome']; ?></td>
                            <td><?php echo $row['data']; ?></td>
                            <td><?php echo $row['descricao']; ?></td>
                            <td>
                                <a href="editar_evento.php?id=<?php echo $row['id']; ?>">Editar</a> |
                                <a href="excluir_evento.php?id=<?php echo $row['id']; ?>">Excluir</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Nenhum evento cadastrado.</p>
        <?php } ?>
    </div>
</body>
</html>
