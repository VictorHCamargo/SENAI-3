<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(Request $request) {
        $search = $request->query('search');
        $url = $search ? "https://dummyjson.com/users/search?q={$search}" : "https://dummyjson.com/users";
        
        $response = Http::withoutVerifying()->get($url);
        $users = $response->json()['users'] ?? [];

        return view('users', compact('users', 'search'));
    }

    public function show($id) {
        $response = Http::withoutVerifying()->get("https://dummyjson.com/users/{$id}");
        return $response->json(); 
    }
}
