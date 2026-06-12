<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class GraficoPedidosMensais extends ChartWidget
{
    protected ?string $heading = 'Pedidos por Mês';

    protected string $color = 'primary';

    protected function getData(): array
    {
        $inicio = now()->subMonths(5)->startOfMonth();
        $labels = [];
        $totais = [];

        for ($mes = 0; $mes < 6; $mes++) {
            $data = $inicio->copy()->addMonths($mes);
            $labels[] = ucfirst($data->translatedFormat('M/Y'));
            $totais[] = Pedido::whereBetween('created_at', [
                $data->copy()->startOfMonth(),
                $data->copy()->endOfMonth(),
            ])->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => $totais,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
