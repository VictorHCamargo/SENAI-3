// Exercício 1: Conversor de Temperatura Dinâmico
/*Objetivo: Criar um formulário onde o usuário digita uma temperatura em Celsius
e, ao clicar, o JS calcula o Fahrenheit e altera a cor de fundo da página baseada no
resultado.
• HTML: Um input tipo número e um button.
• JS: Função que aplica a fórmula $F = C \times 1.8 + 32$.
• CSS: Se $F > 80$, o fundo fica "quente" (coral/laranja); se for menor, fica
"frio" (lightskyblue). */

var inputTemp = document.getElementById("temperatura")
var pResultado = document.getElementById("resultado")
var card = document.getElementById("card")
function conversao() {
    var tempCelsius = inputTemp.value
    var tempFahrenheit = Math.ceil((tempCelsius * 9/5) + 32)
    if(tempFahrenheit >= 80) {
        card.classList.remove("cold")
        card.classList.add("heat")
    } else {
        card.classList.remove("heat")
        card.classList.add("cold")
    }
    pResultado.innerHTML = `O resultado da conversão é ${tempFahrenheit} ºF`
}