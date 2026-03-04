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
}
