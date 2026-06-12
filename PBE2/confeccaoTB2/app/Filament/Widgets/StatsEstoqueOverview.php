<?php

namespace App\Filament\Widgets;

use App\Models\Estoque;
use App\Models\Fornecedor;
use App\Models\Insumo;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsEstoqueOverview extends StatsOverviewWidget
{
    protected ?string $heading = 'Resumo do Estoque';

    protected function getStats(): array
    {
        return [
            Stat::make('Total de Produtos no Estoque', Estoque::sum('quantidade'))
                ->icon(Heroicon::OutlinedArchiveBox)
                ->color('info'),
            Stat::make('Estoque Crítico', Estoque::where('quantidade', '<=', 5)->count())
                ->icon(Heroicon::OutlinedExclamationTriangle)
                ->color('danger'),
            Stat::make('Insumos Cadastrados', Insumo::count())
                ->icon(Heroicon::OutlinedBeaker)
                ->color('success'),
            Stat::make('Fornecedores Ativos', Fornecedor::where('ativo', true)->count())
                ->icon(Heroicon::OutlinedBuildingStorefront)
                ->color('success'),
        ];
    }
}
