function atualizarPlacar() {
    fetch("atualizar_placar.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("placar").innerHTML = data;
        });
}

setInterval(atualizarPlacar, 5000);
