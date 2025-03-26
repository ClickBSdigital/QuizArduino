<?php
include "../config/database.php";

$logs = $conn->query("SELECT * FROM logs ORDER BY timestamp DESC LIMIT 20");
?>

<h2>📜 Logs do Sistema</h2>
<table border="1">
    <tr>
        <th>Usuário</th>
        <th>Ação</th>
        <th>Data</th>
    </tr>
    <?php while ($log = $logs->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $log["usuario"]; ?></td>
            <td><?php echo $log["acao"]; ?></td>
            <td><?php echo $log["timestamp"]; ?></td>
        </tr>
    <?php } ?>
</table>
