// Exercício 5: Varredura de Compromissos (Loops)
/*Contexto: Você recebeu uma lista de horários de compromissos para o dia, mas alguns
horários foram registrados incorretamente (números negativos ou acima de 23). Você
precisa filtrar essa lista e gerar um relatório. Tarefa: Crie um script que:
1. Tenha um Array chamado agendaHorarios contendo os valores: [8, 12, 25, 15, -
2, 20].
2. Utilize uma estrutura de repetição para percorrer cada item dessa lista.
3. Dentro do loop, use uma lógica de decisão para:
o Se o horário for válido (entre 0 e 23), imprima: "Compromisso agendado
para as Xh".
o Se o horário for inválido (menor que 0 ou maior que 23), imprima:
"Atenção: O horário Xh é inválido!".

4. Desafio Extra: Crie uma variável contagemValidos que comece em 0 e, a cada
horário válido encontrado, some +1. Ao final do loop, mostre o total de
compromissos válidos. */

var agendaHorarios = [8, 12, 25, 15, -2, 20]
var contagemValidos = 0
agendaHorarios.forEach((horario) => {
    var horarioValido = horario >= 0 && horario <= 23
    if(horarioValido) {
        alert(`Compromisso agendado para as ${horario} horas`)
        contagemValidos += 1
    } else {
        alert(`Atenção: O horário ${horario} é inválido!`)
    }
})
alert(`Total de horarios válido é: ${contagemValidos}`)