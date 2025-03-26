<?php
$host = "localhost";
$user = "root";  // Altere se necessário
$pass = "";      // Altere se necessário
$dbname = "competicao";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Função para registrar logs
function registrarLog($usuario, $acao) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO logs (usuario, acao) VALUES (?, ?)");
    $stmt->bind_param("ss", $usuario, $acao);
    $stmt->execute();
}
?>
?>
