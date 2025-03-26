<?php
session_start();
include "../Config/database.php";

if (!isset($_SESSION["usuario_id"]) || $_SESSION["usuario_tipo"] != "aluno") {
    header("Location: ../index.php");
    exit;
}

$evento_id = 1; // Definir de acordo com o evento ativo

// Pega uma pergunta aleatória que ainda não foi respondida
$sql = "SELECT * FROM perguntas WHERE evento_id = $evento_id ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "<h2>Não há mais perguntas disponíveis!</h2>";
    exit;
}

$pergunta = $result->fetch_assoc();
$respostas = [
    ["texto" => $pergunta["resposta_correta"], "correta" => 1],
    ["texto" => $pergunta["resposta_errada1"], "correta" => 0],
    ["texto" => $pergunta["resposta_errada2"], "correta" => 0],
    ["texto" => $pergunta["resposta_errada3"], "correta" => 0],
    ["texto" => $pergunta["resposta_errada4"], "correta" => 0],
];

shuffle($respostas);
?>

<h2><?php echo $pergunta["enunciado"]; ?></h2>
<form id="formResposta">
    <?php foreach ($respostas as $r) { ?>
        <button type="button" class="resposta" data-correta="<?php echo $r['correta']; ?>">
            <?php echo $r["texto"]; ?>
        </button>
    <?php } ?>
</form>

<script>
document.querySelectorAll(".resposta").forEach(btn => {
    btn.addEventListener("click", function() {
        let correta = this.getAttribute("data-correta") == "1";
        let audio = new Audio(correta ? "assets/success.mp3" : "assets/error.mp3");
        audio.play();

        if (correta) {
            fetch("atualizar_pontuacao.php", {
                method: "POST",
                body: new URLSearchParams({ equipe_id: <?php echo $_SESSION['usuario_id']; ?> })
            }).then(() => location.reload());
        }
    });
});
</script>
