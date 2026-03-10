<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clientes>
 */
class ClientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fakerBr = Faker::create('pt_BR');
        return [
            'nome'     => $fakerBr->name(),
            'cpf'      => $fakerBr->numerify('###.###.###-##'), 
            'email'    => $fakerBr->unique()->safeEmail(),
            'telefone' => $fakerBr->cellphone(), 
            'endereco' => $fakerBr->address(),
        ];
    }
}
