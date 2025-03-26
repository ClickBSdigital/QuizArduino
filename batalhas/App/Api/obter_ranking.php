<?php
require_once '../config/database.php';

$result = $conn->query("SELECT equipe, pontos FROM placar ORDER BY pontos DESC");
$equipes = [];
$pontos = [];
while ($row = $result->fetch_assoc()) {
    $equipes[] = $row['equipe'];
    $pontos[] = $row['pontos'];
}
echo json_encode(["equipes" => $equipes, "pontos" => $pontos]);
?>
