<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use Illuminate\Http\Request;

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
}
