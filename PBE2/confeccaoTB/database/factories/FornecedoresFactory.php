<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fornecedores>
 */
class FornecedoresFactory extends Factory
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
            "nome_fantasia" => $fakerBr->company(), 
            "razao_social"  => $fakerBr->company() . " " . $fakerBr->companySuffix(), 
            "cnpj"          => $fakerBr->cnpj(), 
            "email"         => $fakerBr->unique()->companyEmail(),
            "telefone"      => $fakerBr->landline(), 
            "categoria"     => $fakerBr->randomElement(["Tecidos", "Linhas", "Botões", "Zíperes", "Embalagens"]),
            "endereco"      => $fakerBr->address(),
        ];
    }
}
