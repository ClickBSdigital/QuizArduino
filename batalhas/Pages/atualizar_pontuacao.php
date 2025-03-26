<?php
include "../Config/database.php";

$equipe_id = $_POST["equipe_id"];
$conn->query("UPDATE pontuacoes SET pontos = pontos + 1 WHERE equipe_id = $equipe_id");

$pontos = $conn->query("SELECT pontos FROM pontuacoes WHERE equipe_id = $equipe_id")->fetch_assoc()["pontos"];
$max_pontos = $conn->query("SELECT MAX(pontos) as max_pontos FROM pontuacoes")->fetch_assoc()["max_pontos"];

if ($pontos >= $max_pontos) {
    echo "audio:corneta_vitoria.mp3";
} else {
    echo "audio:ponto.mp3";
}
?>
