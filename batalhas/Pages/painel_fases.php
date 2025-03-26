<?php
session_start();
include "../config/database.php";

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] != "professor") {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT equipes.nome, fases.nome AS fase_atual, fases.premio 
        FROM equipes 
        JOIN fases ON equipes.fase_atual = fases.id
        ORDER BY fases.id DESC";

$result = $conn->query($sql);
?>

<h2>Painel de Fases e Prêmios</h2>
<table>
    <tr>
        <th>Equipe</th>
        <th>Fase Atual</th>
        <th>Prêmio</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $row["nome"]; ?></td>
            <td><?php echo $row["fase_atual"]; ?></td>
            <td><?php echo $row["premio"]; ?></td>
            <td>
                <button onclick="liberarPremio(<?php echo $row['fase_atual']; ?>)">Liberar Prêmio</button>
            </td>
        </tr>
    <?php } ?>
</table>

<script>
function liberarPremio(fase_id) {
    fetch("liberar_premio.php", {
        method: "POST",
        body: new URLSearchParams({ fase_id: fase_id })
    }).then(() => alert("Prêmio liberado!"));
}
</script>
