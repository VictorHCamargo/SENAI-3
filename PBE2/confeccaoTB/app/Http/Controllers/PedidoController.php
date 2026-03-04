<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index() {
        $pedidos =  Pedidos::all();
        return view("pedidos.index",compact('pedidos'));
    }
}
