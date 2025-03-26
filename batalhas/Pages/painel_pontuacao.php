<?php
session_start();
include "../Config/database.php";

$sql = "SELECT equipes.nome, pontuacoes.pontos FROM equipes 
        JOIN pontuacoes ON equipes.id = pontuacoes.equipe_id
        ORDER BY pontuacoes.pontos DESC";

$result = $conn->query($sql);
?>

<h2>Pontuação Atual</h2>
<table>
    <tr>
        <th>Equipe</th>
        <th>Pontos</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["nome"]; ?></td>
            <td><?php echo $row["pontos"]; ?></td>
        </tr>
    <?php } ?>
</table>
