<?php
include "../config/database.php";

$fase_id = $_POST["fase_id"];
$conn->query("UPDATE fases SET liberado = 1 WHERE id = $fase_id");

echo "Prêmio liberado!";
?>
