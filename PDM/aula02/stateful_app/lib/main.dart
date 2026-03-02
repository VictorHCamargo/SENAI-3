import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(home: PaginaContador())); 
}

class PaginaContador extends StatefulWidget {
  @override
  _PaginaContadorState createState() =>  _PaginaContadorState();
}

class _PaginaContadorState extends State<PaginaContador> {
  int contador = 0;


  void increment() {
    if(contador >= 10) {
      setState(() {
        contador++;
      });
    }
    contador++;
  }
  void deincrement() {
    if(contador >= 10) {
      setState(() {
        contador++;
      });
    }
    contador++;
  }
  @override
  Widget build(BuildContext context) {
    return Scaffold(
    appBar: AppBar(title: Text("Meu Primeiro contador")),
    body: Center(
        child:Text(
          "Cliques: $contador",
          style: TextStyle(
            fontSize: 30,
            backgroundColor: Color.fromRGBO(8, 49, 73, 1),
            fontFamily: "Times New Roman",
            color: Color.fromRGBO(255, 255, 255, 1)
            )
        )
      ),
    floatingActionButton: FloatingActionButton(
      onPressed: deincrement,
      child: Icon(Icons.remove_done),
      ),
    );
  }
}
 