<?php
session_start();
if (!isset($_SESSION["usuario_tipo"]) || $_SESSION["usuario_tipo"] != "professor") {
    header("Location: ../index.php");
    exit;
}
?>

<h2>Painel do Professor</h2>
<ul>
    <li><a href="gerenciar_eventos.php">Gerenciar Eventos</a></li>
    <li><a href="gerenciar_perguntas.php">Gerenciar Perguntas</a></li>
    <li><a href="gerenciar_fases.php">Definir Fases e Prêmios</a></li>
</ul>
