<?php

namespace App\Http\Controllers;

use App\Models\Produtos;
use App\Models\Fornecedores;
use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index() {
        $estoque = Estoque::all();
        return view('estoque.index',compact('estoque'));
    }
    public function create()
    {
        // Busca produtos e fornecedores para os selects opcionais
        $produtos = Produtos::orderBy('nome', 'asc')->get();
        $fornecedores = Fornecedores::orderBy('nome_fantasia', 'asc')->get();
        
        return view('estoque.create', compact('produtos', 'fornecedores'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item' => 'required|string|max:255',
            'produto_id' => 'nullable|exists:produtos,id',
            'fornecedor_id' => 'nullable|exists:fornecedores,id',
            'quantidade_atual' => 'required|numeric',
            'quantidade_minima' => 'required|numeric',
            'unidade_medida' => 'required|string|max:50',
            'valor_unitario' => 'required|numeric',
            'localizacao' => 'nullable|string|max:255',
        ]);

        Estoque::create($validated);

        return redirect()->route('estoque')
            ->with('success', 'Insumo registrado no estoque com sucesso!');
    }
}
