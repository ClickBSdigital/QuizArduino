<?php
include '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pergunta = $_POST['pergunta'];
    $resposta_correta = $_POST['resposta_correta'];
    $resposta_errada1 = $_POST['resposta_errada1'];
    $resposta_errada2 = $_POST['resposta_errada2'];
    $resposta_errada3 = $_POST['resposta_errada3'];
    createQuiz($pergunta, $resposta_correta, $resposta_errada1, $resposta_errada2, $resposta_errada3);
    header('Location: quiz.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Pergunta</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastrar Pergunta</h1>
        <form action="quiz.php" method="POST">
            <label for="pergunta">Pergunta:</label>
            <textarea name="pergunta" id="pergunta" required></textarea>
            <label for="resposta_correta">Resposta Correta:</label>
            <input type="text" id="resposta_correta" name="resposta_correta" required>
            <label for="resposta_errada1">Resposta Errada 1:</label>
            <input type="text" id="resposta_errada1" name="resposta_errada1" required>
            <label for="resposta_errada2">Resposta Errada 2:</label>
            <input type="text" id="resposta_errada2" name="resposta_errada2" required>
            <label for="resposta_errada3">Resposta Errada 3:</label>
            <input type="text" id="resposta_errada3" name="resposta_errada3" required>
            <button type="submit">Cadastrar Pergunta</button>
        </form>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
