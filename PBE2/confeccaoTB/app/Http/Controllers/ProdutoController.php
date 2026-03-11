<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProdutoController extends Controller
{
    public function index() {
        $produtos =  Produtos::all();
        return view("produtos.index",compact('produtos'));
    }
    public function create()
    {
        return view('produtos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sku' => 'nullable|string|max:255|unique:produtos',
            'preco_venda' => 'required|numeric',
            'tamanho' => 'nullable|string|max:50',
            'cor' => 'nullable|string|max:50',
            'tecido' => 'nullable|string|max:100',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean', // O checkbox manda 1 se marcado, 0 se não (graças ao input hidden na view)
        ]);

        Produtos::create($validated);

        return redirect()->route('produtos')
            ->with('success', 'Produto adicionado ao catálogo com sucesso!');
    }
    public function edit(Produtos $produto) {
        return view('produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produtos $produto) {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'sku' => ['nullable', 'string', 'max:255', Rule::unique('produtos')->ignore($produto->id)],
            'preco_venda' => 'required|numeric',
            'tamanho' => 'nullable|string|max:50',
            'cor' => 'nullable|string|max:50',
            'tecido' => 'nullable|string|max:100',
            'descricao' => 'nullable|string',
            'ativo' => 'boolean',
        ]);

        $produto->update($validated);
        return redirect()->route('produtos')->with('success','Produto atualizado com sucesso!!');
    }

    public function destroy(Produtos $produto) {
        $produto->delete();
        return redirect()->route('produtos')->with('success','Produto removido!!');
    }
}
