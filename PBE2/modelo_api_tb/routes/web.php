<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Usuario;

Route::get('pokemon/{nome}',function ($nome) {
    $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$nome}");
    if($response->successful()) {
        $dados = $response->json();
        return response()->json([
            'status' => 'Conectado com sucesso!',
            'resultado' => [
                'identificador' => $dados['id'],
                'nomePokemon' => ucfirst($dados['name']),
                'foto' => $dados['sprites']['front_default']
            ]
        ],200);
    }
    return response()->json(['erro' => 'Pokemon não encontrado!'],404);
});

Route::post('pokemon',function (Request $request) {
    $dados = $request->validate([
        'nome' => 'required|string|min:3',
        'tipo' => 'required|string',
        'ataque' => 'required|integer',
    ]);

    return response()->json([
        'mensagem' => 'Pókemon cadastrado com sucesso!',
        'id_gerado' => rand(1000,9999),
        'dados_recebidos' => $dados
    ],201);
});

Route::get('user', function () {
    $response = Http::withoutVerifying()->get("https://dummyjson.com/users");

    if ($response->successful()) {
        $dados = $response->json();

        $usuarios = collect($dados['users'])->map(function ($user) {
            return [
                'id' => $user['id'],
                'nome'      => $user['firstName'],
                'sobrenome' => $user['lastName'],
                'cargo'     => $user['company']['title'],
                'email'     => $user['email'],
                'telefone'  => $user['phone'],
                'niveAcesso' => $user['role'],
                'fotoPerfil' => $user['image']
            ];
        });

        return response()->json([
            'status'    => 'Usuários buscados!',
            'resultado' => $usuarios
        ]);
    }
});

Route::get('user/{id}',function ($id) {
    $response = Http::withoutVerifying()->get("https://dummyjson.com/users/{$id}");

    if ($response->successful()) {
        $dados = $response->json();

        return response()->json([
            'status'    => 'Usuários buscados!',
            'resultado' => [
                'nome'      => $dados['firstName'],
                'sobrenome' => $dados['lastName'],
                'cargo'     => $dados['company']['title'],
                'email'     => $dados['email'],
                'telefone'  => $dados['phone'],
                'niveAcesso' => $dados['role'],
                'fotoPerfil' => $dados['image']
            ]
        ]);
    }
});

Route::post('user', function (Request $request) {
    $dados = $request->validate([
        'nome'      => 'required|string|min:3',
        'sobrenome' => 'required|string|min:3',
        'cargo'     => 'required|string',
        'email'     => 'required|email',
        'telefone'  => 'required|string|min:8',
    ]);

    return response()->json([
        'mensagem'        => 'Usuário cadastrado com sucesso!',
        'id_gerado'       => rand(1000, 9999),
        'dados_recebidos' => $dados
    ], 201);
});


Route::get('usuarios', function () {
    $usuarios = Usuario::all();

    return response()->json([
        'status'    => 'Usuários buscados!',
        'resultado' => $usuarios
    ]);
});

Route::get('usuario/{id}' , function ($id) {
    $usuario = Usuario::find($id);

    return response()->json([
        'status'    => 'Usuários buscados!',
        'resultado' => $usuario
    ]);
});

Route::post('usuarios', function (Request $request) {
    $dados = $request->validate([
        'nome'      => 'required|string|min:3',
        'sobrenome' => 'required|string|min:3',
        'cargo'     => 'required|string',
        'email'     => 'required|email|unique:usuarios,email',
        'telefone'  => 'required|string|min:8',
    ]);

    $usuario = Usuario::create([
        'nome'      => $dados['nome'],
        'sobrenome' => $dados['sobrenome'],
        'cargo'     => $dados['cargo'],
        'email'     => $dados['email'],
        'telefone'  => $dados['telefone'],
    ]);

    return response()->json([
        'mensagem' => 'Usuário cadastrado com sucesso!',
        'usuario'  => $usuario
    ], 201);
});

Route::get('/', function () {
    return view('welcome');
});
