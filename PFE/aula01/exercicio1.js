// Exercício 1: Verificador de Turno e Prioridade

/* Contexto: Na sua agenda, cada tarefa tem uma hora (0-23) e um nível de prioridade (1
a 10). Tarefa: Escreva um script que:
1. Receba a hora e a prioridade.
2. Verifique se a hora está entre 0 e 11 (Manhã), 12 e 17 (Tarde) ou 18 e 23
(Noite).
3. Use um operador lógico para imprimir “TAREFA CRÍTICA/URGENTE” se a
prioridade for maior que 8 E o turno for "Manhã" ou “Tarde”.
4. Use um operador lógico para imprimir “TAREFA IMPORTANTE” se a prioridade
for maior ou igual a 7 e menor que 9 E o turno for “Manhã” ou“Tarde”.
5. Use um operador lógico para imprimir “TAREFA NÃO IMPORTANTE”
independentemente da prioridade E o turno for “Noite”. Esta agenda valoriza as
noites para lazer e não para tarefas.
6. Imprima "Horário Inválido" caso o número esteja fora de 0-23 e “Nível de
Prioridade Inválida” caso o número esteja fora de 1-10. */
var erro = false;
var horario;
var hora = prompt("Que Hora é agora?\n");

if(hora >= 0 && hora <=11) {
    horario = "Manhã";
} else if (hora >= 12 && hora <= 17) {
    horario = "Tarde";
} else if (hora >= 18 && hora <= 23) {
    horario = "Noite";
} else {
    horario = "Horário Inválido (00-23 são aceitos)";
}

var prioridade = prompt("Define a prioridade dessa tarefa: (1-10)\n");
if(horario == "Horário Inválido (00-23 são aceitos)") {
    alert("Horário Inválido");
    erro = true;
}
if(prioridade <= 0 || prioridade >= 11) {
    alert("Nível de Prioridade Inválida");
    erro = true;
}
if(!erro) {
    if(prioridade < 7) {
        alert("TAREFA NÃO IMPORTANTE");
    }
    switch(horario) {
        case 'Manhã':
            if(prioridade > 8) {
                alert("TAREFA CRÍTICA/URGENTE");
            } else if(prioridade >= 7 && prioridade <= 8) {
                alert("TAREFA IMPORTANTE");
            }
            break;
        case 'Tarde':
            if(prioridade > 8) {
                alert("TAREFA CRÍTICA/URGENTE");
            } else if(prioridade >= 7 && prioridade <= 8) {
                alert("TAREFA IMPORTANTE");
            }
            break;
        case 'Noite':
            alert("TAREFA NÃO IMPORTANTE");
            break;
    }
}

