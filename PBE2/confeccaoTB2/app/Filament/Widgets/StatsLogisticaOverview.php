<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsLogisticaOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Operação Logística';

    protected function getStats(): array
    {
        return [
            Stat::make('Pedidos Pendentes', Pedido::where('status', 'Pendente')->count())
                ->icon(Heroicon::OutlinedClock)
                ->color('warning'),
            Stat::make('Pedidos Em Produção', Pedido::where('status', 'Em Produção')->count())
                ->icon(Heroicon::OutlinedCog)
                ->color('info'),
            Stat::make('Para Entrega Hoje', Pedido::where('status', 'Para Entrega')->whereDate('created_at', today())->count())
                ->icon(Heroicon::OutlinedTruck)
                ->color('success'),
            Stat::make('Pedidos do Dia', Pedido::whereDate('created_at', today())->count())
                ->icon(Heroicon::OutlinedCalendar)
                ->color('info'),
        ];
    }
}
