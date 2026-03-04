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
    Route::get('/pedidos', [PedidoController::class, 'index'])->name('pedidos');
    Route::get('/fornecedores', [FornecedorController::class, 'index'])->name('fornecedores');
    Route::get('/estoque', [EstoqueController::class, 'index'])->name('estoque');
    Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos');
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
