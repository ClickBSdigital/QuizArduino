<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_quiz = $_GET['id'];
    deleteQuiz($id_quiz);
    header('Location: quiz.php');
    exit();
}

function deleteQuiz($id_quiz) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM quiz WHERE id_quiz = ?");
    $stmt->execute([$id_quiz]);
}
?>
