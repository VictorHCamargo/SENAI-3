<?php

namespace Database\Factories;

use App\Models\Clientes;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pedidos>
 */
class PedidosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cliente_id' => Clientes::factory(),
            'numero_pedido' => 'PCI-' . fake()->unique()->numberBetween(1000, 9999),
            'descricao_itens' => fake()->sentence(10), 
            'valor_total' => fake()->randomFloat(2, 100, 5000),
            'entrada' => fake()->randomFloat(2, 50, 500),
            'status' => fake()->randomElement(['pendente', 'em_producao', 'finalizado', 'entregue', 'cancelado']),
            'data_entrega_prevista' => fake()->dateTimeBetween('now', '+1 month'),
            'data_entrega_realizada' => null, // Geralmente começa vazio
            'observacoes' => fake()->optional()->realText(100),
        ];
    }
}
