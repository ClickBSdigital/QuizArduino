<?php
session_start();
include('config/database.php');

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

if (isset($_GET['id'])) {
    $evento_id = $_GET['id'];
    $sql = "SELECT * FROM eventos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $evento_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $evento = $result->fetch_assoc();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome_evento = $_POST['nome_evento'];
        $data_evento = $_POST['data_evento'];
        $descricao_evento = $_POST['descricao_evento'];

        $update_sql = "UPDATE eventos SET nome = ?, data = ?, descricao = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("sssi", $nome_evento, $data_evento, $descricao_evento, $evento_id);
        $update_stmt->execute();

        header('Location: gerenciar_eventos.php');
    }
} else {
    header('Location: gerenciar_eventos.php');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <header>
        <h1>Editar Evento</h1>
    </header>

    <div class="container">
        <form action="editar_evento.php?id=<?php echo $evento['id']; ?>" method="POST">
            <label for="nome_evento">Nome do Evento:</label>
            <input type="text" name="nome_evento" id="nome_evento" value="<?php echo $evento['nome']; ?>" required>

            <label for="data_evento">Data do Evento:</label>
            <input type="date" name="data_evento" id="data_evento" value="<?php echo $evento['data']; ?>" required>

            <label for="descricao_evento">Descrição do Evento:</label>
            <textarea name="descricao_evento" id="descricao_evento" required><?php echo $evento['descricao']; ?></textarea>

            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
