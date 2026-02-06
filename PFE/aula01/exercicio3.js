// Exercício 3: Formatador de Nomes para a Agenda
/*Contexto: Usuários costumam digitar nomes de contatos de qualquer jeito (com
espaços extras ou letras minúsculas). Tarefa: Crie uma função chamada
limparNomeContato(nome) que:
1. Receba uma string (ex: " joão silva ").
2. Remova os espaços em branco no início e no fim.
3. Transforme toda a string em letras maiúsculas.
4. Retorne a string formatada.
5. Bônus: Use o método split() e length para contar quantas palavras o nome
possui.*/
var caracteres = 0;
var string = prompt("Escreva seu nome:\n")


var nomeFormatado = limparNomeContato(string)

alert("Seu nome formatado ficou: \n " + nomeFormatado + "\n Quantidade de Caracteres é: " + caracteres)

function limparNomeContato(nome) { 
    let nomeLimpo = nome.trim().toUpperCase()
    let arrayNome = nomeLimpo.split(" ")
    arrayNome.forEach(fragmento => {
        caracteres += fragmento.length
    });
    return nomeLimpo
}