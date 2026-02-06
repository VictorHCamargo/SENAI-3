// Exercício 2: Gerador de Cartão de Visitas (Live Preview)
/*Objetivo: Criar um formulário que, conforme o usuário digita, atualiza um "cartão"
estilizado ao lado em tempo real.
• HTML: Campos para "Nome", "Cargo", Cor e uma div que será o cartão.
• JS: Use o evento oninput ou onkeyup para capturar o que o usuário digita e
injetar o texto dentro do cartão usando innerText.
• CSS: Estilize o cartão com border-radius, box-shadow e use Flexbox para
centralizar o texto.
• CSS: Campo cor poderá ter 5 cores já pré-definida por você. O usuário
escolhe uma das cores e ela é aplicada em tempo real ao cartão.
Dica: Tente usar variáveis CSS (Custom Properties) para mudar a cor do cartão via
JS quando o usuário selecionar uma cor em um input type="color".*/

var card = document.getElementById("card")

function preenchendo(elemento,id) {
    var resultado = document.getElementById(id)
    resultado.innerHTML = elemento.value
}

function preenchendoCor(elemento) {
    card.style = `background-color: ${elemento.value};`
}