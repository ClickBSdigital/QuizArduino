<?php
require_once '../Config/auth.php';
verificarLogin();
?>
<h1>Bem-vindo, <?= $_SESSION['usuario_nome'] ?>!</h1>
<a href="../logout.php">Sair</a>
<!-- Proteger páginas com verificarLogin()
Exemplo em dashboard.php: -->


<?php
session_start();
include "../config/database.php";

$sql = "SELECT equipes.nome, SUM(pontuacoes.pontos) AS total_pontos 
        FROM equipes 
        JOIN pontuacoes ON equipes.id = pontuacoes.equipe_id 
        GROUP BY equipes.nome";

$result = $conn->query($sql);
$equipes = [];
$pontos = [];

while ($row = $result->fetch_assoc()) {
    $equipes[] = $row["nome"];
    $pontos[] = $row["total_pontos"];
}
?>

<h2>📊 Desempenho das Equipes</h2>
<canvas id="grafico"></canvas>

<script>
const ctx = document.getElementById('grafico').getContext('2d');
const grafico = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($equipes); ?>,
        datasets: [{
            label: 'Pontos',
            data: <?php echo json_encode($pontos); ?>,
            backgroundColor: ['#FF5733', '#33FF57', '#3357FF'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>
