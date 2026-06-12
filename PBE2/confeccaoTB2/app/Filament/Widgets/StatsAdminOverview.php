<?php

namespace App\Filament\Widgets;

use App\Models\Cliente;
use App\Models\Pedido;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Visão Geral';

    protected function getStats(): array
    {
        return [
            Stat::make('Total de Pedidos', Pedido::count())
                ->icon(Heroicon::OutlinedShoppingCart)
                ->color('info'),
            Stat::make('Pedidos Pendentes', Pedido::where('status', 'Pendente')->count())
                ->icon(Heroicon::OutlinedClock)
                ->color('warning'),
            Stat::make('Clientes Cadastrados', Cliente::count())
                ->icon(Heroicon::OutlinedUsers)
                ->color('success'),
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
