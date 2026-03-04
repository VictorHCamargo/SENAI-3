<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            "nome_fantasia" => fake()->company(),
            "razao_social" => fake()->company() . " LTDA",
            "cnpj" => fake()->numerify("##.###.###/0001-##"),
            "email" => fake()->unique()->companyEmail(),
            "telefone" => fake()->phoneNumber(),
            "categoria" => fake()->randomElement(["Tecidos", "Linhas", "Botões", "Zíperes", "Embalagens"]),
            "endereco" => fake()->address(),
        ];
    }
}
