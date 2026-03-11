<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/clientes', [ClienteController::class, 'index'])->name('clientes');
    Route::get('/clientes/create',[ClienteController::class,'create'])->name('clientes.create');
    Route::post('/clientes/create', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/edit/{id}',[ClienteController::class,'edit'])->name('clientes.edit');
    Route::put('/clientes/edit/{cliente}',[ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('clientes/delete/{id}',[ClienteController::class, 'destroy'])->name('clientes.destroy');
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');
    Route::get('/pedidos/create', [PedidoController::class, 'create'])->name('pedidos.create');
    Route::post('/pedidos/create', [PedidoController::class, 'store'])->name('pedidos.store');
    Route::get('/pedidos/edit/{pedido}', [PedidoController::class, 'edit'])->name('pedidos.edit');
    Route::put('/pedidos/edit/{pedido}', [PedidoController::class, 'update'])->name('pedidos.update');
    Route::delete('/pedidos/delete/{pedido}', [PedidoController::class, 'destroy'])->name('pedidos.destroy');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');
    Route::get('/fornecedores/create', [FornecedorController::class, 'create'])->name('fornecedores.create');
    Route::post('/fornecedores/create', [FornecedorController::class, 'store'])->name('fornecedores.store');
    Route::get('/fornecedores/edit/{fornecedor}', [FornecedorController::class, 'edit'])->name('fornecedores.edit');
    Route::put('/fornecedores/edit/{fornecedor}', [FornecedorController::class, 'update'])->name('fornecedores.update');
    Route::delete('/fornecedores/delete/{fornecedor}', [FornecedorController::class, 'destroy'])->name('fornecedores.destroy');
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque');
    Route::get('/estoque/create', [EstoqueController::class, 'create'])->name('estoque.create');
    Route::post('/estoque/create', [EstoqueController::class, 'store'])->name('estoque.store');
    Route::get('/estoque/edit/{estoque}', [EstoqueController::class, 'edit'])->name('estoque.edit');
    Route::put('/estoque/edit/{estoque}', [EstoqueController::class, 'update'])->name('estoque.update');
    Route::delete('/estoque/delete/{estoque}', [EstoqueController::class, 'destroy'])->name('estoque.destroy');
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos/create', [ProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/edit/{produto}', [ProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/edit/{produto}', [ProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/delete/{produto}', [ProdutoController::class, 'destroy'])->name('produtos.destroy');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
