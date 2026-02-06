// Exercício 4: Contador de Dias para o Evento
/* Contexto: Sua agenda precisa calcular quantos dias faltam para um compromisso.
Tarefa: Desenvolva um script que:
1. Crie um objeto de data para a "Data de Hoje" e outro para a "Data do Evento".
2. Calcule a diferença em milissegundos entre elas.
3. Converta essa diferença para dias (Dica: $1 \text{ dia} = 24 \times 60 \times 60
\times 1000 \text{ ms}$).
4. Use a função Math.ceil() para arredondar o resultado para cima.
5. Exiba no console: "Faltam X dias para o seu compromisso!". */

var dataHoje = new Date();
// Para trocar a data do evento substitua dentro do construtor abaixo
var dataEvento = new Date("February 24, 2026")

var diferenca = dataEvento.getTime() - dataHoje.getTime()

var dias = diferenca/ 1000/ 60/ 60/24

console.log(`Faltam ${Math.ceil(dias)} dias para o seu compromisso!`)