<?php
include '../includes/functions.php';

if (isset($_SESSION['user']) && $_SESSION['user']['tipo'] == 'professor') {
    $relatorios = getAllReports();
} else {
    header('Location: login.php');
    exit();
}

function getAllReports() {
    global $pdo;
    $stmt = $pdo->query("SELECT relatorio.*, usuarios.nome AS nome_usuario, quiz.pergunta FROM relatorio
                         JOIN usuarios ON relatorio.user_id = usuarios.id
                         JOIN quiz ON relatorio.quiz_id = quiz.id");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Relatórios dos Alunos</h1>
        <table>
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Pergunta</th>
                    <th>Resposta</th>
                    <th>Resultado</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($relatorios as $relatorio): ?>
                <tr>
                    <td><?php echo $relatorio['nome_usuario']; ?></td>
                    <td><?php echo $relatorio['pergunta']; ?></td>
                    <td><?php echo $relatorio['resposta_usuario']; ?></td>
                    <td><?php echo $relatorio['resultado']; ?></td>
                    <td><?php echo $relatorio['created_at']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
