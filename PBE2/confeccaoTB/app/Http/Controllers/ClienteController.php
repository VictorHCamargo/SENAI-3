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
}
