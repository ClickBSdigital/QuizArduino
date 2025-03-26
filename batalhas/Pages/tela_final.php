<?php
session_start();
include "../Config/database.php";

$sql = "SELECT equipes.nome, pontuacoes.pontos, fases.premio 
        FROM equipes 
        JOIN pontuacoes ON equipes.id = pontuacoes.equipe_id
        JOIN fases ON equipes.fase_atual = fases.id
        ORDER BY pontuacoes.pontos DESC
        LIMIT 3";

$result = $conn->query($sql);
?>

<h2>🏆 Campeões da Competição 🏆</h2>
<table>
    <tr>
        <th>Posição</th>
        <th>Equipe</th>
        <th>Pontos</th>
        <th>Prêmio</th>
    </tr>
    <?php $posicao = 1; ?>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $posicao++; ?>º</td>
            <td><?php echo $row["nome"]; ?></td>
            <td><?php echo $row["pontos"]; ?></td>
            <td><?php echo $row["premio"]; ?></td>
        </tr>
    <?php } ?>
</table>

<button onclick="window.location.href='index.php'">Voltar ao Início</button>

<script>
document.addEventListener("DOMContentLoaded", () => {
    let audio = new Audio("assets/corneta_vitoria.mp3");
    audio.play();
});
</script>
