<?php
session_start();
include "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento_id = $_POST["evento_id"];
    $enunciado = $_POST["enunciado"];
    $resposta_correta = $_POST["resposta_correta"];
    $respostas_erradas = [$_POST["resposta_errada1"], $_POST["resposta_errada2"], $_POST["resposta_errada3"], $_POST["resposta_errada4"]];

    $sql = "INSERT INTO perguntas (evento_id, enunciado, resposta_correta, resposta_errada1, resposta_errada2, resposta_errada3, resposta_errada4) 
            VALUES ('$evento_id', '$enunciado', '$resposta_correta', '$respostas_erradas[0]', '$respostas_erradas[1]', '$respostas_erradas[2]', '$respostas_erradas[3]')";

    if ($conn->query($sql)) {
        echo "Pergunta cadastrada com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<form method="POST">
    <input type="text" name="enunciado" placeholder="Enunciado" required>
    <input type="text" name="resposta_correta" placeholder="Resposta Correta" required>
    <input type="text" name="resposta_errada1" placeholder="Resposta Errada 1" required>
    <input type="text" name="resposta_errada2" placeholder="Resposta Errada 2" required>
    <input type="text" name="resposta_errada3" placeholder="Resposta Errada 3" required>
    <input type="text" name="resposta_errada4" placeholder="Resposta Errada 4" required>
    <button type="submit">Cadastrar Pergunta</button>
</form>
