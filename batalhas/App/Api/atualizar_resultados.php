<?php
require_once '../config/database.php';

$result = $conn->query("SELECT equipe, pontos FROM placar ORDER BY pontos DESC");
$placarHTML = "<ul>";
while ($row = $result->fetch_assoc()) {
    $placarHTML .= "<li>{$row['equipe']} - {$row['pontos']} pontos</li>";
}
$placarHTML .= "</ul>";

echo json_encode(["placarHTML" => $placarHTML]);
?>
