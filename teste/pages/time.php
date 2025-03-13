<?php
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome_time = $_POST['nome_time'];
    $professor_id = $_SESSION['user']['id']; // O professor logado cria o time

    createTeam($nome_time, $professor_id);
    header('Location: time.php');
    exit();
}

function createTeam($nome_time, $professor_id) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO time (nome_time, professor_id) VALUES (?, ?)");
    $stmt->execute([$nome_time, $professor_id]);
}

$teams = getAllTeams();

function getAllTeams() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM time");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Times - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Times</h1>
        
        <form action="time.php" method="POST">
            <label for="nome_time">Nome do Time:</label>
            <input type="text" id="nome_time" name="nome_time" required>
            <button type="submit">Cadastrar Time</button>
        </form>

        <h2>Times Cadastrados</h2>
        <ul>
            <?php foreach ($teams as $team): ?>
                <li><?php echo $team['nome_time']; ?> (Professor: <?php echo $team['professor_id']; ?>)</li>
            <?php endforeach; ?>
        </ul>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
