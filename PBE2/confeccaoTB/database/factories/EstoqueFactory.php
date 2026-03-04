<?php

namespace Database\Factories;

use App\Models\Fornecedores;
use App\Models\Produtos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Estoque>
 */
class EstoqueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            "produto_id"       => Produtos::factory(), 
            "fornecedor_id"    => Fornecedores::factory(),
            "item"             => fake()->randomElement(["Tecido Viscose", "Linha Poliéster", "Botão", "Zíper"]),
            "unidade_medida"   => fake()->randomElement(["Metros", "Unidades", "KG"]),
            "quantidade_atual" => fake()->numberBetween(10, 500),
            "quantidade_minima" => 20,
            "valor_unitario"   => fake()->randomFloat(2, 0.50, 50.00),
            "localizacao"      => "Corredor " . fake()->randomElement(["A", "B"]) . "-" . fake()->numberBetween(1, 10),
        ];
    }
}
