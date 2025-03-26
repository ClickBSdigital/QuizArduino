<?php
require_once '../Config/database.php';

class Evento {
    public static function criarEvento($nome, $descricao, $professor_id) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO eventos (nome, descricao, professor_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $nome, $descricao, $professor_id);
        return $stmt->execute();
    }
}
?>
