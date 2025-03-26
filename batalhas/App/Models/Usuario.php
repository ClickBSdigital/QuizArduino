<?php
require_once '../Config/database.php';

class Usuario {
    public static function criarUsuario($nome, $email, $senha, $tipo) {
        global $conn;
        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $senha_hash, $tipo);
        return $stmt->execute();
    }
}
?>
