<?php
include "../Config/database.php";

$sql = "SELECT equipes.nome, pontuacoes.pontos FROM equipes 
        JOIN pontuacoes ON equipes.id = pontuacoes.equipe_id
        ORDER BY pontuacoes.pontos DESC";

$result = $conn->query($sql);

echo "<table>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['nome']}</td><td>{$row['pontos']}</td></tr>";
}
echo "</table>";
?>
