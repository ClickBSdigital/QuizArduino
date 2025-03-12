<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_time = $_GET['id'];
    deleteTeam($id_time);
    header('Location: time.php');
    exit();
}

function deleteTeam($id_time) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM time WHERE id_time = ?");
    $stmt->execute([$id_time]);
}
?>
