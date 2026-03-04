<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produtos>
 */
class ProdutosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
{
    return [
        'nome'        => fake()->randomElement(['Camiseta', 'Calça', 'Vestido', 'Bermuda']) . ' ' . fake()->word(),
        'sku'         => strtoupper(fake()->unique()->bothify('CONF-###??')),
        'descricao'   => fake()->sentence(),
        'tamanho'     => fake()->randomElement(['P', 'M', 'G', 'GG', '38', '40', '42']),
        'cor'         => fake()->safeColorName(),
        'tecido'      => fake()->randomElement(['Algodão', 'Poliéster', 'Linho', 'Viscose']),
        'preco_venda' => fake()->randomFloat(2, 29, 299),
        'ativo'       => true,
    ];
}
}
