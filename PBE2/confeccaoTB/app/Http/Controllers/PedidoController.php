<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Pedidos;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PedidoController extends Controller
{
    public function index() {
        $pedidos =  Pedidos::all();
        return view("pedidos.index",compact('pedidos'));
    }
    public function create()
    {
        // Busca todos os clientes para popular o select do formulário
        $clientes = Clientes::orderBy('nome', 'asc')->get();
        
        return view('pedidos.create', compact('clientes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'numero_pedido' => 'required|string|max:255|unique:pedidos',
            'status' => 'required|string',
            'data_entrega_prevista' => 'nullable|date',
            'data_entrega_realizada' => 'nullable|date',
            'valor_total' => 'required|numeric',
            'entrada' => 'nullable|numeric',
            'descricao_itens' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        Pedidos::create($validated);

        return redirect()->route('pedidos')
            ->with('success', 'Pedido cadastrado com sucesso!');
    }
    public function edit(Pedidos $pedido) {
        $clientes = Clientes::all(); // Busca os clientes para o dropdown
        return view('pedidos.edit', compact('pedido', 'clientes'));
    }

    public function update(Request $request, Pedidos $pedido) {
        $validated = $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'numero_pedido' => ['required', 'string', 'max:255', Rule::unique('pedidos')->ignore($pedido->id)],
            'status' => 'required|string',
            'data_entrega_prevista' => 'nullable|date',
            'data_entrega_realizada' => 'nullable|date',
            'valor_total' => 'required|numeric',
            'entrada' => 'nullable|numeric',
            'descricao_itens' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        $pedido->update($validated);
        return redirect()->route('pedidos')->with('success','Pedido atualizado com sucesso!!');
    }

    public function destroy(Pedidos $pedido) {
        $pedido->delete();
        return redirect()->route('pedidos')->with('success','Pedido removido!!');
    }
}
