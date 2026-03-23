import 'package:flutter/material.dart';

void main() {
  runApp(MaterialApp(
    debugShowCheckedModeBanner: false,
    home: ListaContato(), //TelaInicial()
  ));
}
class Contato {
  final String nome;
  final String telefone;
  final MaterialColor corFundo;
  final IconData icone;

  const Contato({
    required this.nome,
    required this.telefone,
    required this.corFundo,
    this.icone = Icons.phone_android,
  });
}

class ListaContato extends StatelessWidget {
  ListaContato({super.key});

  final List<Contato> listaContatos = [
    Contato(nome: "Victor", telefone: "19984445631", corFundo: Colors.deepPurple, icone: Icons.person),
    Contato(nome: "Rau", telefone: "19923212424", corFundo: Colors.deepOrange, icone: Icons.person_2),
    Contato(nome: "Miguel", telefone: "19993212442", corFundo: Colors.cyan,icone: Icons.person)
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          "Lista de Contatos",
          style: TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        backgroundColor: Colors.blue.shade700,
        elevation: 4,
      ),
      body: ListView.builder(
        padding: const EdgeInsets.symmetric(vertical: 12, horizontal: 8),
        itemCount: listaContatos.length,
        itemBuilder: (context, index) {
          final Contato contato = listaContatos[index];
          return Card(
            margin: const EdgeInsets.symmetric(vertical: 6),
            elevation: 3,
            shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(12)),
            child: ListTile(
              contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 8),
              leading: CircleAvatar(
                backgroundColor: contato.corFundo,
                child: Icon(contato.icone, color: Colors.white),
              ),
              title: Text(
                contato.nome,
                style: const TextStyle(fontWeight: FontWeight.bold, fontSize: 16),
              ),
              subtitle: Text(
                contato.telefone,
                style: TextStyle(color: Colors.grey.shade600),
              ),
              trailing: const Icon(Icons.arrow_forward_ios, size: 16),
              onTap: () {
                Navigator.push(
                  context,
                  MaterialPageRoute(builder: (context) => PaginaContato(contato: contato)),
                );
              },
            ),
          );
        },
      ),
    );
  }
}

class PaginaContato extends StatelessWidget {
  final Contato contato;
  const PaginaContato({super.key, required this.contato});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          contato.nome,
          style: const TextStyle(color: Colors.white, fontWeight: FontWeight.bold),
        ),
        backgroundColor: contato.corFundo,
        iconTheme: const IconThemeData(color: Colors.white),
      ),
      body: Center(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            CircleAvatar(
              radius: 60,
              backgroundColor: contato.corFundo,
              child: Icon(contato.icone, size: 60, color: Colors.white),
            ),
            const SizedBox(height: 24),
            Text(
              contato.nome,
              style: const TextStyle(fontSize: 28, fontWeight: FontWeight.bold),
            ),
            const SizedBox(height: 8),
            Row(
              mainAxisAlignment: MainAxisAlignment.center,
              children: [
                Icon(Icons.phone, color: Colors.grey.shade600, size: 18),
                const SizedBox(width: 6),
                Text(
                  contato.telefone,
                  style: TextStyle(fontSize: 18, color: Colors.grey.shade700),
                ),
              ],
            ),
            const SizedBox(height: 40),
            ElevatedButton.icon(
              style: ElevatedButton.styleFrom(
                backgroundColor: contato.corFundo,
                foregroundColor: Colors.white,
                padding: const EdgeInsets.symmetric(horizontal: 32, vertical: 14),
                shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(30)),
                elevation: 4,
              ),
              icon: const Icon(Icons.call),
              label: const Text("Ligar", style: TextStyle(fontSize: 16)),
              onPressed: () {
                ScaffoldMessenger.of(context).showSnackBar(
                  SnackBar(
                    content: Row(
                      children: [
                        const Icon(Icons.call, color: Colors.white),
                        const SizedBox(width: 10),
                        Text("Ligando para ${contato.nome}..."),
                      ],
                    ),
                    backgroundColor: contato.corFundo,
                    duration: const Duration(seconds: 3),
                    behavior: SnackBarBehavior.floating,
                    shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(10)),
                  ),
                );
              },
            ),
          ],
        ),
      ),
    );
  }
}
// class TelaInicial extends StatelessWidget {
//   final String nome = "Victor Hugo Camargo";
//   const TelaInicial({super.key});
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       appBar: AppBar(
//         title: Text('Tela inicial'),
//         backgroundColor: Colors.blue,
//       ),
//       body: Center(
//         child: ElevatedButton(
//           child: Text('Ir para a Segunda Tela'),
//           onPressed:  () {
//             Navigator.push(
//               context,
//               MaterialPageRoute(builder: (context) => SegundaTela(nome: nome))
//             );
//           }
//         ),
//       ),
//     );
//   }
// }

// class SegundaTela extends StatelessWidget {
//   final String nome;
//   const SegundaTela({
//     super.key,
//     required this.nome
//     });
//   @override
//   Widget build(BuildContext context) {
//     return Scaffold(
//       appBar: AppBar(
//         title: Text("Segunda Tela"),
//         backgroundColor: Colors.red,
//       ),
//       body: Center(
//         child: Text("Olá $nome, bem vindo a segunda tela"),
//       ),
//     );
//   }
// }