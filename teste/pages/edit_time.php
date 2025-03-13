<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_time = $_GET['id'];
    $time = getTeamById($id_time);
} else {
    header('Location: time.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_time = $_POST['nome_time'];
    updateTeam($id_time, $nome_time);
    header('Location: time.php');
    exit();
}

function getTeamById($id_time) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM time WHERE id_time = ?");
    $stmt->execute([$id_time]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateTeam($id_time, $nome_time) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE time SET nome_time = ? WHERE id_time = ?");
    $stmt->execute([$nome_time, $id_time]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Time - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Time</h1>
        
        <form action="edit_time.php?id=<?php echo $time['id_time']; ?>" method="POST">
            <label for="nome_time">Nome do Time:</label>
            <input type="text" id="nome_time" name="nome_time" value="<?php echo $time['nome_time']; ?>" required>
            <button type="submit">Atualizar Time</button>
        </form>

        <a href="time.php">Voltar</a>
    </div>
</body>
</html>
