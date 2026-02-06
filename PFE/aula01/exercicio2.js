// Exercício 2: Calculadora de Gastos Mensais
/*Contexto: Você quer adicionar uma função financeira à agenda para calcular quanto
sobra do salário após as contas. Tarefa: Crie um script que:
1. Receba as variáveis salario, aluguel, alimentacao e lazer.
2. Calcule o total de despesas e o saldo restante usando operadores aritméticos.
3. Use uma estrutura if/else para exibir:
o "Saldo Positivo" se o saldo for maior que 0.
o "No Limite" se o saldo for exatamente 0.
o "Saldo Negativo" se o saldo for menor que 0. */
var salario;
var despesas = 0;
var perguntas = ["salário","aluguel","alimentacao","lazer"]
var respostas = []
for(let index = 0; index<perguntas.length;index++) {
    var pergunta = prompt(`Qual é o valor de seu ${perguntas[index]}`)
    respostas.push(pergunta);
}
respostas.forEach((resposta,index) => {
    if(index == 0) {
        salario = resposta ? parseFloat(resposta) : parseFloat("0")
    } else {
        despesas += resposta ? parseFloat(resposta) : parseFloat("0")
    }
})

var saldo = salario - despesas;

if(saldo > 0) {
    alert("Saldo Positivo")
} else if(saldo == 0) {
    alert("No Limite")
} else if(saldo <  0) {
    alert("Saldo Negativo")
}