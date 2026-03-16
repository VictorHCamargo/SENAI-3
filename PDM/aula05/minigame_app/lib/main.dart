import 'package:flutter/material.dart';
import 'dart:math';


void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: GameApp()
  ));
}

class GameApp extends StatefulWidget {
  const GameApp({super.key});

  @override
  State<StatefulWidget> createState() {
    return _GameAppState();
  }
}

class _GameAppState extends State<GameApp> {
  IconData iconeComputador = Icons.computer;
  String resultado = "Escolha uma opção";
  int pontosJogador = 0;
  int pontosComputador = 0;
  List opcoes = ["pedra","papel","tesoura"];
  void resetarPlacar(){
    setState(() {
      pontosComputador = 0;
      pontosJogador = 0;
    });
  }
  void jogar(String escolhaUsuario) {
    var numero = Random().nextInt(3);

    var escolhaComputador = opcoes[numero];

    setState(() {
      switch(escolhaComputador) {
        case "pedra":
          iconeComputador = Icons.circle;
          break;
        case "papel" :
          iconeComputador = Icons.pan_tool;
          break;
        case "tesoura":
          iconeComputador = Icons.content_cut;
          break;
      }
      if(escolhaUsuario == escolhaComputador) {
        resultado = "empate";
      } else if(
        (escolhaUsuario == "pedra" && escolhaComputador == "tesoura") || (escolhaUsuario == "papel" && escolhaComputador == "pedra") || (escolhaUsuario == "tesoura" && escolhaComputador == "papel")
      ) {
        pontosJogador++;
        resultado = "O jogador venceu";
      } else {
        pontosComputador++;
        resultado = "O computador venceu";
      }

      if(pontosComputador == 5 || pontosJogador ==5 ){
        resultado = pontosComputador ==5 ? "Parabéns o Computador ganhou" : "Parabéns o Jogador ganhou";

        resetarPlacar();
      }
    });
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Jogo do Papel, Pedra ou Tesoura"),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Text("Computador"),
            Icon(
              iconeComputador,
              size: 100,
            ),
            Text(
              resultado,
              style: TextStyle(fontSize: 68),
            ),
            Text("Computador: $pontosComputador || Jogador: $pontosJogador"),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                IconButton(onPressed: () => jogar("pedra"), icon: Icon(Icons.landscape)),
                IconButton(onPressed: () => jogar("tesoura"), icon: Icon(Icons.content_cut)),
                IconButton(onPressed: () => jogar("papel"), icon: Icon(Icons.pan_tool)),
              ],
            ),
            ElevatedButton.icon(onPressed: resetarPlacar,icon: Icon(Icons.refresh), label: Text("Resetar Placar"))
          ],
        ),
      ),
    );
  }
}