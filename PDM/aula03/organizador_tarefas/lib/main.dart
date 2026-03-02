import 'package:flutter/material.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override 
  Widget build(BuildContext context) {
    return const MaterialApp(
      home: TodoPage(),
    );
  }
}

class TodoPage extends StatefulWidget {
  const TodoPage({super.key});

  @override 
  State<TodoPage> createState() => _TodoPageState(); 
}

class _TodoPageState extends State<TodoPage> {
  final List<String> tarefas = [];
  final TextEditingController tarefaController = TextEditingController();

  void adicionarTarefa() {
    if (tarefaController.text.trim().isEmpty) {
      ScaffoldMessenger.of(context).showSnackBar(
        const SnackBar(
          content: Text("Por favor, digite o nome da tarefa!"),
          backgroundColor: Colors.redAccent, 
          duration: Duration(seconds: 2)
        ),
      );
      
    } else {
      setState(() {
        tarefas.add(tarefaController.text);
      });
      tarefaController.clear();
    }
  }

  void removerTarefa(int index) {
    setState(() {
      tarefas.removeAt(index);
    });
  }
  // 
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Column(
          children: [
            const Text("Organizador de Tarefas"),
            Text(
              "Quantidade de tarefas: ${tarefas.length}",
              style: TextStyle(
                fontSize: 14,
                fontStyle: FontStyle.normal
              )
            )
          ],
        )
      ),
      body: Column(
        children: [
          TextField(
            controller: tarefaController, 
            decoration: const InputDecoration(
              hintText: "Digite o nome da tarefa", 
              border: OutlineInputBorder(), 
            ),
            onSubmitted: (String valorDigitado) {
              adicionarTarefa(); 
            },
            textInputAction: TextInputAction.done,
          ),
          ElevatedButton(
            onPressed: adicionarTarefa,
            child: const Text("Adicionar")
          ),
          Expanded(
            child: tarefas.isEmpty 
                ? 
                const Center(
                    child: Text(
                      "A lista está vazia",
                      style: TextStyle(fontSize: 18, color: Color.fromARGB(255, 247, 3, 3)), 
                    ),
                  )
                : 
                ListView.builder(
                    itemCount: tarefas.length,
                    itemBuilder: (context, index) {
                      return ListTile(
                        title: Text(tarefas[index]),
                        trailing: IconButton(
                          onPressed: () => removerTarefa(index),
                          icon: const Icon(Icons.delete, color: Colors.red),
                  ),
                );
              },
            )
          )
        ]
      )
    );
  }
}