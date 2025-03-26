setInterval(() => {
    fetch("atualizar_pontuacao.php")
        .then(response => response.text())
        .then(audio => {
            if (audio.includes("audio:")) {
                let som = new Audio(audio.replace("audio:", ""));
                som.play();
            }
        });
}, 5000);
