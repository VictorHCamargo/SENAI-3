import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: TermometroApp()
  ));
}

class TermometroApp extends StatefulWidget {
  const TermometroApp({super.key});
  @override
  State<StatefulWidget> createState() {
    return _TermometroAppState();
  }
}

class _TermometroAppState extends State<TermometroApp> {
  int temperatura = 20;
  void aumentar() { 
    setState(() {
      temperatura++;
    });
  }
  void diminuir() {
    setState(() {
      temperatura--;
    });
  }
  @override
  Widget build(BuildContext context) {
    Color corFundo;
    IconData icone;
    String status;
    if(temperatura < 15) {
      corFundo = Colors.blue;
      icone = Icons.ac_unit;
      status = "Frio";
    } else if (temperatura < 30) {
      corFundo = Colors.green;
      icone = Icons.wb_sunny;
      status = "Agradável";
    } else {
      corFundo = Colors.red;
      icone = Icons.local_fire_department;
      status = "Quente";
    }
    return Scaffold(
      backgroundColor: corFundo,
      appBar: AppBar(
        title: Text("Controle de Temperatura"),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              icone,
              size: 100,
            ),
            Text(
              "$temperatura °C",
              style: TextStyle(fontSize: 40),
            ),
            Text(
              status,
              style: TextStyle(fontSize: 28),
            ),
            SizedBox(height: 20),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                ElevatedButton(onPressed: aumentar, child: Text("+")),
                SizedBox(width: 20),
                ElevatedButton(onPressed: diminuir, child: Text("-"))
              ],
            )
          ],
        ),
      ),
    );
  }
}