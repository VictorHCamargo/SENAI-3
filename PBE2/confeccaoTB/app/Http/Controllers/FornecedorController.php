<?php

namespace App\Http\Controllers;

use App\Models\Fornecedores;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function index() {
        $fornecedores = Fornecedores::all();
        return view('fornecedores.index',compact('fornecedores'));
    }
    public function create()
    {
        return view('fornecedores.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:20|unique:fornecedores',
            'categoria' => 'nullable|string|max:100',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string',
        ]);

        Fornecedores::create($validated);

        return redirect()->route('fornecedores')
            ->with('success', 'Fornecedor cadastrado com sucesso!');
    }
    public function edit(Fornecedores $fornecedor) {
        return view('fornecedores.edit', compact('fornecedor'));
    }

    public function update(Request $request, Fornecedores $fornecedor) {
        $validated = $request->validate([
            'nome_fantasia' => 'required|string|max:255',
            'razao_social' => 'nullable|string|max:255',
            'categoria' => 'nullable|string|max:100',
            'telefone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'endereco' => 'nullable|string',
        ]);

        $fornecedor->update($validated);
        return redirect()->route('fornecedores')->with('success','Fornecedor atualizado!!');
    }

    public function destroy(Fornecedores $fornecedor) {
        $fornecedor->delete();
        return redirect()->route('fornecedores')->with('success','Fornecedor removido!!');
    }
}
