<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_relatorio = $_GET['id'];
    $relatorio = getRelatorioById($id_relatorio);
} else {
    header('Location: relatorio.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $acertos = $_POST['acertos'];
    $erros = $_POST['erros'];
    updateRelatorio($id_relatorio, $id_usuario, $acertos, $erros);
    header('Location: relatorio.php');
    exit();
}

function getRelatorioById($id_relatorio) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM relatorio WHERE id_relatorio = ?");
    $stmt->execute([$id_relatorio]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateRelatorio($id_relatorio, $id_usuario, $acertos, $erros) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE relatorio SET id_usuario = ?, acertos = ?, erros = ? WHERE id_relatorio = ?");
    $stmt->execute([$id_usuario, $acertos, $erros, $id_relatorio]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Relatório - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Relatório</h1>

        <form action="edit_relatorio.php?id=<?php echo $relatorio['id_relatorio']; ?>" method="POST">
            <label for="id_usuario">ID do Usuário:</label>
            <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $relatorio['id_usuario']; ?>" required>

            <label for="acertos">Número de Acertos:</label>
            <input type="number" id="acertos" name="acertos" value="<?php echo $relatorio['acertos']; ?>" required>

            <label for="erros">Número de Erros:</label>
            <input type="number" id="erros" name="erros" value="<?php echo $relatorio['erros']; ?>" required>

            <button type="submit">Atualizar Relatório</button>
        </form>

        <a href="relatorio.php">Voltar</a>
    </div>
</body>
</html>
