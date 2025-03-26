<h2>🕒 Tempo Restante: <span id="timer">30</span> segundos</h2>

<script>
let tempo = 30; 
const timerElement = document.getElementById("timer");

const cronometro = setInterval(() => {
    tempo--;
    timerElement.textContent = tempo;

    if (tempo === 10) {
        timerElement.style.color = "red"; 
    }

    if (tempo === 0) {
        clearInterval(cronometro);
        alert("Tempo esgotado!");
        window.location.href = "proxima_pergunta.php"; 
    }
}, 1000);
</script>
