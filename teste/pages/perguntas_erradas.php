<?php
include '../includes/functions.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

$usuario_id = $_SESSION['user']['id'];
$perguntas_erradas = getIncorrectQuestions($usuario_id);

function getIncorrectQuestions($usuario_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM perguntas_erradas WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perguntas Erradas - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Perguntas Erradas</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Pergunta</th>
                    <th>Resposta Correta</th>
                    <th>Resposta Dada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perguntas_erradas as $pergunta): ?>
                    <tr>
                        <td><?php echo $pergunta['pergunta']; ?></td>
                        <td><?php echo $pergunta['resposta_correta']; ?></td>
                        <td><?php echo $pergunta['resposta_dada']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
