function mostrarNotificacao(mensagem) {
    let notificacao = document.createElement("div");
    notificacao.classList.add("notificacao");
    notificacao.innerHTML = mensagem;
    document.body.appendChild(notificacao);
    
    setTimeout(() => {
        notificacao.remove();
    }, 5000);
}

// Exemplo de uso:
mostrarNotificacao("🎉 Equipe Azul acabou de passar de fase!");
