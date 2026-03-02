import 'package:flutter/material.dart';
import 'dart:math';

void main() {
  runApp(MaterialApp(home: PaginaSorteadora()));
}

class PaginaSorteadora extends StatefulWidget {
  @override
  _PaginaSorteadoraState createState() => _PaginaSorteadoraState();
}

class _PaginaSorteadoraState extends State<PaginaSorteadora> {
  int number = 0;

  void sortear() {
    setState(() {
      number = Random().nextInt(11);
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
    appBar: AppBar(
        title: Text("Sorteadora de Numeros")
      ),
    body: Center(
      child: Text(
        "O número Sorteado foi: $number",
        style: TextStyle(
            fontSize: 40,
            color: Color.fromRGBO(100, 0, 100, 1),
            backgroundColor: Color.fromRGBO(200, 200, 55, 1)
        ),
      )
    ),
    floatingActionButton: FloatingActionButton(
      onPressed: sortear,
      child: Icon(Icons.refresh)
      )
    );
  }
}