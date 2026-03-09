import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: HumorPage(),
  ));
}

class HumorPage extends StatefulWidget {
  const HumorPage({super.key});
  @override
  State<HumorPage> createState() => _HumorPageState();
}

class _HumorPageState extends State<HumorPage> {
  final List<String> humores = ['bravo','neutro','feliz'];
  String humorSelecionado = "";
  int indexAtual = 0;
  void geradorIndex() {
    indexAtual = (indexAtual + 1) % humores.length;
    trocarHumor(indexAtual);
  }
  void trocarHumor(int index) {
    setState(() {
      humorSelecionado = humores[index];
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text("Adaptando ao tipo de Humor", 
          style: TextStyle(
              color: switch(humorSelecionado) {
                "bravo" => Colors.white,
                "neutro" => Colors.black,
                "feliz" => Colors.black,
                _ => Colors.black
              }
            ),
          ),
        backgroundColor: switch(humorSelecionado) {
          "bravo" => Colors.red,
          "neutro" => Colors.grey,
          "feliz" => Colors.green,
          _ => Colors.grey
        },
      ),
      body: Center(
        child: Column(
          mainAxisAlignment : MainAxisAlignment.center,
          children: [
            Icon(
              switch(humorSelecionado) {
                "bravo" => Icons.sentiment_very_dissatisfied,
                "neutro" => Icons.sentiment_neutral,
                "feliz" => Icons.sentiment_very_satisfied,
                _ => Icons.sentiment_neutral
              },
              size: 100,
              color: switch(humorSelecionado) {
                "bravo" => Colors.red,
                "neutro" => Colors.grey,
                "feliz" => Colors.green,
                _ => Colors.grey
              }
            ),
            ElevatedButton(
              onPressed: geradorIndex, 
              child: Text("Trocar Humor",
                  style: TextStyle(
                  color: switch(humorSelecionado) {
                    "bravo" => Colors.red,
                    "neutro" => Colors.black,
                    "feliz" => Colors.green,
                    _ => Colors.black
                  }
                )
              ),
            )
          ],
        ),
      ),
    );
  }

}