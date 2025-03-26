<?php
include "../Config/database.php";

// Verifica a equipe vencedora
$sql = "SELECT equipe_id, SUM(pontos) AS total_pontos FROM pontuacoes GROUP BY equipe_id ORDER BY total_pontos DESC LIMIT 1";
$result = $conn->query($sql);
$equipe_vencedora = $result->fetch_assoc();

if ($equipe_vencedora) {
    $id_vencedor = $equipe_vencedora["equipe_id"];
    
    // Atribuir um prêmio automático
    $descricao_premio = "🏆 Troféu da Competição!";
    $conn->query("INSERT INTO premios (equipe_id, descricao) VALUES ('$id_vencedor', '$descricao_premio')");
    
    echo "Equipe vencedora premiada!";
}
?>
