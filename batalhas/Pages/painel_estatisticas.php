<?php
require_once '../config/auth.php';
verificarLogin();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <title>Estatísticas</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="grafico"></canvas>
    <script>
        fetch("../api/obter_ranking.php")
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById("grafico").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: data.equipes,
                    datasets: [{
                        label: "Pontuação",
                        data: data.pontos,
                        backgroundColor: "blue"
                    }]
                }
            });
        });
    </script>
</body>
</html>
