<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Estoque;
use App\Models\Pedidos;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Clientes cadastrados nos últimos 30 dias
        $clientesUltimoMes = Clientes::where('created_at', '>=', Carbon::now()->subDays(30))->count();

        // 2. Valor Total de Lucro/Receita (Soma de todos os pedidos)
        $receitaTotal = Pedidos::sum('valor_total');
        
        // Receita apenas deste mês (opcional, mas muito útil)
        $receitaMes = Pedidos::whereMonth('created_at', Carbon::now()->month)
                            ->whereYear('created_at', Carbon::now()->year)
                            ->sum('valor_total');

        // 3. Pedidos realizados por cliente (Top 5 clientes que mais compram)
        $topClientes = Clientes::withCount('pedidos')
                              ->orderByDesc('pedidos_count')
                              ->take(5)
                              ->get();

        // 4. Estoque se aproximando de estar vazio (Atual <= Mínima)
        $estoqueBaixo = Estoque::whereColumn('quantidade_atual', '<=', 'quantidade_minima')
                               ->orderBy('quantidade_atual', 'asc')
                               ->get();

        return view('dashboard', compact(
            'clientesUltimoMes', 
            'receitaTotal', 
            'receitaMes', 
            'topClientes', 
            'estoqueBaixo'
        ));
    }
}
