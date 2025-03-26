<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id_pergunta_errada = $_GET['id'];
    deletePerguntaErrada($id_pergunta_errada);
    header('Location: perguntas_erradas.php');
    exit();
}

function deletePerguntaErrada($id_pergunta_errada) {
    global $pdo;
    $stmt = $pdo->prepare("DELETE FROM perguntas_erradas WHERE id_pergunta_errada = ?");
    $stmt->execute([$id_pergunta_errada]);
}
?>
