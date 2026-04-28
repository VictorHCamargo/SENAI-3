<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PokemonController extends Controller
{
    public function index() {
        $id = rand(1,1010);
        $response = Http::withoutVerifying()->get("https://pokeapi.co/api/v2/pokemon/{$id}");
        
        if($response->successful()) {
            $pokemon = $response->json();
            $speciesResp = Http::withoutVerifying()->get($pokemon['species']['url']);
            $species = $speciesResp->json();

            return view('pokemon', compact('pokemon', 'species'));    
        }
        return "Erro ao buscar dados na API";
    }
}
