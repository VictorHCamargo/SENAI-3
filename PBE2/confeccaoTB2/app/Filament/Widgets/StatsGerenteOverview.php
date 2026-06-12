<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsGerenteOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Resumo Gerencial';

    protected function getStats(): array
    {
        return [
            Stat::make('Pedidos do Mês', Pedido::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count())
                ->icon(Heroicon::OutlinedCalendarDays)
                ->color('info'),
            Stat::make('Pedidos em Produção', Pedido::where('status', 'Em Produção')->count())
                ->icon(Heroicon::OutlinedCog)
                ->color('info'),
            Stat::make('Pedidos Para Entrega', Pedido::where('status', 'Para Entrega')->count())
                ->icon(Heroicon::OutlinedTruck)
                ->color('warning'),
            Stat::make('Faturamento do Mês', $this->formatarMoeda(
                Pedido::where('status', 'Finalizado')
                    ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('valor_total')
            ))
                ->icon(Heroicon::OutlinedBanknotes)
                ->color('success'),
        ];
    }

    private function formatarMoeda(float|int|string|null $valor): string
    {
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }
}
