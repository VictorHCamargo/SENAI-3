<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Clientes;
use App\Models\Pedidos;
use App\Models\Estoque;
use App\Models\Produtos;
use App\Models\Fornecedores;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Clientes::factory(5)->create();
        Pedidos::factory(10)->create();
        Fornecedores::factory(5)->create();
        Produtos::factory(5)->create();
        Estoque::factory(5)->create();
        
        User::firstOrCreate(
            ['email' => 'test@example.com'], 
            [
                'name' => 'Test User',
                'password' => 'test1234', 
            ]
        );
    }
}
