function abrirEmPopup(pagina, largura, altura) {
    // Definindo centro da tela
    var esquerda = (screen.width - largura) / 2;
    var topo = (screen.height - altura) / 2;

    // Abre a nova janela
    minhaJanela = window.open(pagina, '', 'height=' + altura + ', width=' + largura + ', top=' + topo + ', left=' + esquerda);
}