<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
class ClienteController extends Controller
{
    public function index() {
        $clientes = Clientes::all();
        return view('clientes.index',compact('clientes'));
    }

    public function create() {
        return view('clientes.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:clientes',
            'email' => 'required|email|unique:clientes',
            'telefone' => 'required|string',
            'endereco' => 'nullable|string'
        ]);
        Clientes::create($request->all());

        return redirect()->route('clientes')->with('success','Cliente cadastrado com sucesso');
    }
    public function edit($id) {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }
    public function update(Request $request,Clientes $cliente) {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:clientes,email,'.  $cliente->id,
            'telefone' => 'required|string',
            'endereco' => 'nullable|string'
        ]);
        $cliente->update($request->all());

        return redirect()->route('clientes')->with('success','Cliente atualizado!!');
    }

    public function destroy($id) {
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes')->with('success','Cliente removido!!');
    }
}
