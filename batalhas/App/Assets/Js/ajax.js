function atualizarPlacar() {
    fetch("../api/atualizar_resultados.php")
        .then(response => response.json())
        .then(data => {
            document.getElementById("placar").innerHTML = data.placarHTML;
        })
        .catch(error => console.error("Erro ao atualizar placar:", error));
}

setInterval(atualizarPlacar, 5000); // Atualiza a cada 5 segundos
