<?php
session_start();
include "../Config/database.php";

if (!isset($_SESSION["usuario_id"])) {
    die("Acesso negado");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mensagem = $_POST["mensagem"];
    $usuario = $_SESSION["usuario_nome"];

    $conn->query("INSERT INTO chat (usuario, mensagem) VALUES ('$usuario', '$mensagem')");
}

$mensagens = $conn->query("SELECT * FROM chat ORDER BY id DESC LIMIT 10");
?>

<h2>💬 Chat da Competição</h2>
<div id="chat-box">
    <?php while ($msg = $mensagens->fetch_assoc()) { ?>
        <p><strong><?php echo $msg["usuario"]; ?>:</strong> <?php echo $msg["mensagem"]; ?></p>
    <?php } ?>
</div>

<input type="text" id="mensagem" placeholder="Digite sua mensagem...">
<button onclick="enviarMensagem()">Enviar</button>

<script>
function enviarMensagem() {
    let mensagem = document.getElementById("mensagem").value;

    fetch("chat.php", {
        method: "POST",
        body: new URLSearchParams({ mensagem: mensagem })
    }).then(() => {
        document.getElementById("mensagem").value = "";
        atualizarChat();
    });
}

function atualizarChat() {
    fetch("chat.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("chat-box").innerHTML = data;
        });
}

setInterval(atualizarChat, 3000);
</script>
