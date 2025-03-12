<?php
include 'db.php';

// Função para cadastrar usuário (professor ou aluno)
function registerUser($nome, $email, $senha, $tipo) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $email, password_hash($senha, PASSWORD_DEFAULT), $tipo]);
}

// Função para login do usuário
function loginUser($email, $senha) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        return $user;
    }
    return false;
}

// Função para listar todos os quizzes
function getAllQuizzes() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM quiz");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para cadastrar quiz
function createQuiz($pergunta, $resposta_correta, $resposta_errada1, $resposta_errada2, $resposta_errada3) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO quiz (pergunta, resposta_correta, resposta_errada1, resposta_errada2, resposta_errada3) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$pergunta, $resposta_correta, $resposta_errada1, $resposta_errada2, $resposta_errada3]);
}

// Função para registrar a resposta errada de um aluno
function registerWrongAnswer($user_id, $quiz_id, $resposta_usuario) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO perguntas_erradas (user_id, quiz_id, resposta_usuario) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $quiz_id, $resposta_usuario]);
}

// Função para listar perguntas erradas de um aluno
function getWrongAnswers($user_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM perguntas_erradas WHERE user_id = ?");
    $stmt->execute([$user_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Função para cadastrar relatorio
function createRelatorio($user_id, $quiz_id, $resposta_usuario, $resultado) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO relatorio (user_id, quiz_id, resposta_usuario, resultado) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $quiz_id, $resposta_usuario, $resultado]);
}

// Função para editar quiz
function updateQuiz($id, $pergunta, $resposta_correta, $resposta_errada1, $resposta_errada2, $resposta_errada3) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE quiz SET pergunta = ?, resposta_correta = ?, resposta_errada1 = ?, resposta_errada2 = ?, resposta_errada3 = ? WHERE id = ?");
    $stmt->execute([$pergunta, $resposta_correta, $resposta_errada1, $resposta_errada2, $resposta_errada3, $id]);
}

// Função para deletar quiz
function deleteQuiz($id) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM quiz WHERE id = ?");
    $stmt->execute([$id]);
}

// Funções semelhantes para as tabelas de time e relatorio
?>
