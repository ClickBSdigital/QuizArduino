<?php
session_start();
require_once 'database.php';

function login($email, $senha) {
    global $conn;
    $stmt = $conn->prepare("SELECT id, nome, senha, tipo FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            $_SESSION['usuario_tipo'] = $user['tipo'];
            return true;
        }
    }
    return false;
}

function verificarLogin() {
    if (!isset($_SESSION['usuario_id'])) {
        header("Location: /pages/login.php");
        exit();
    }
}

function logout() {
    session_destroy();
    header("Location: /pages/login.php");
}
?>
