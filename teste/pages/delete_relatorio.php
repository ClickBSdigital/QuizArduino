<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_relatorio = $_GET['id'];
    deleteRelatorio($id_relatorio);
    header('Location: relatorio.php');
    exit();
}

function deleteRelatorio($id_relatorio) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM relatorio WHERE id_relatorio = ?");
    $stmt->execute([$id_relatorio]);
}
?>
