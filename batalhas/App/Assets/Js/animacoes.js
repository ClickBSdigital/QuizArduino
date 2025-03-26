document.addEventListener("DOMContentLoaded", () => {
    let botao = document.querySelectorAll("button");
    botao.forEach(btn => {
        btn.addEventListener("mouseenter", () => {
            btn.style.boxShadow = "0px 0px 10px rgba(255, 75, 43, 0.8)";
        });
        btn.addEventListener("mouseleave", () => {
            btn.style.boxShadow = "none";
        });
    });
});
