<?php
include_once "../Config/database.php"; // Inclui a conexão com o banco

function registrarLog($usuario, $acao) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO logs (usuario, acao) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $acao);
    $stmt->execute();
}
?>
