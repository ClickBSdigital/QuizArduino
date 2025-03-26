<?php
include "../Config/database.php";

$premios = $conn->query("SELECT equipes.nome, premios.descricao, premios.data_entrega 
                         FROM premios 
                         JOIN equipes ON premios.equipe_id = equipes.id 
                         ORDER BY premios.data_entrega DESC");
?>

<h2>🏆 Equipes Premiadas</h2>
<ul>
    <?php while ($premio = $premios->fetch_assoc()) { ?>
        <li><strong><?php echo $premio["nome"]; ?></strong> - <?php echo $premio["descricao"]; ?> (<?php echo $premio["data_entrega"]; ?>)</li>
    <?php } ?>
</ul>
