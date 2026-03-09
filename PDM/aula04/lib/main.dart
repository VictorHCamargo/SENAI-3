import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: InterruptorApp(),
  ));
}

class InterruptorApp extends StatefulWidget {
  const InterruptorApp({super.key});
  @override
  State<InterruptorApp> createState() => _InterruptorAppState();
}

class _InterruptorAppState extends State<InterruptorApp> {
  bool estaAceso = false;
  void alternaLuz() {
    setState(() {
      estaAceso = !estaAceso;
    });
  }


  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: estaAceso ? Colors.black : Colors.white,
      appBar: AppBar(
        title: Text("Troca de temas",
            style: TextStyle(
              color: estaAceso ? Colors.white : Colors.black
            )
          ),
        backgroundColor: estaAceso ? Colors.black : Colors.white,
        ),
      body: Center(
        child: Column(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              Icon(
                estaAceso ? Icons.lightbulb : Icons.lightbulb_outline,
                size: 100,
                color: estaAceso ? Colors.yellow : Colors.black,
              ),
              ElevatedButton(
                onPressed: alternaLuz, 
                child: Text("Trocar", style: TextStyle(color: estaAceso ? Colors.white : Colors.black))
              )
            ],
          ),
        ),
      );
  }
}

