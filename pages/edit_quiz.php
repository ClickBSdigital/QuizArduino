<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_quiz = $_GET['id'];
    $quiz = getQuizById($id_quiz);
} else {
    header('Location: quiz.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pergunta = $_POST['pergunta'];
    $resposta_correta = $_POST['resposta_correta'];
    $resposta_errada_1 = $_POST['resposta_errada_1'];
    $resposta_errada_2 = $_POST['resposta_errada_2'];
    $resposta_errada_3 = $_POST['resposta_errada_3'];
    updateQuiz($id_quiz, $pergunta, $resposta_correta, $resposta_errada_1, $resposta_errada_2, $resposta_errada_3);
    header('Location: quiz.php');
    exit();
}

function getQuizById($id_quiz) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM quiz WHERE id_quiz = ?");
    $stmt->execute([$id_quiz]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateQuiz($id_quiz, $pergunta, $resposta_correta, $resposta_errada_1, $resposta_errada_2, $resposta_errada_3) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE quiz SET pergunta = ?, resposta_correta = ?, resposta_errada_1 = ?, resposta_errada_2 = ?, resposta_errada_3 = ? WHERE id_quiz = ?");
    $stmt->execute([$pergunta, $resposta_correta, $resposta_errada_1, $resposta_errada_2, $resposta_errada_3, $id_quiz]);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Quiz - Quiz Arduino</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Quiz</h1>

        <form action="edit_quiz.php?id=<?php echo $quiz['id_quiz']; ?>" method="POST">
            <label for="pergunta">Pergunta:</label>
            <input type="text" id="pergunta" name="pergunta" value="<?php echo $quiz['pergunta']; ?>" required>

            <label for="resposta_correta">Resposta Correta:</label>
            <input type="text" id="resposta_correta" name="resposta_correta" value="<?php echo $quiz['resposta_correta']; ?>" required>

            <label for="resposta_errada_1">Resposta Errada 1:</label>
            <input type="text" id="resposta_errada_1" name="resposta_errada_1" value="<?php echo $quiz['resposta_errada_1']; ?>" required>

            <label for="resposta_errada_2">Resposta Errada 2:</label>
            <input type="text" id="resposta_errada_2" name="resposta_errada_2" value="<?php echo $quiz['resposta_errada_2']; ?>" required>

            <label for="resposta_errada_3">Resposta Errada 3:</label>
            <input type="text" id="resposta_errada_3" name="resposta_errada_3" value="<?php echo $quiz['resposta_errada_3']; ?>" required>

            <button type="submit">Atualizar Pergunta</button>
        </form>

        <a href="quiz.php">Voltar</a>
    </div>
</body>
</html>
