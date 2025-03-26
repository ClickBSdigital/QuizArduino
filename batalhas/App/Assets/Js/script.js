let audioPonto = new Audio('../assets/sounds/ponto.mp3');
let audioVitoria = new Audio('../assets/sounds/vitoria.mp3');

function tocarSom(evento) {
    if (evento === "ponto") audioPonto.play();
    else if (evento === "vitoria") audioVitoria.play();
}

document.addEventListener("resultadoAtualizado", function(event) {
    tocarSom(event.detail.tipo);
});
