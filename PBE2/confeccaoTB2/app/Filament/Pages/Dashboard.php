<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\GraficoPedidosMensais;
use App\Filament\Widgets\PedidosPendentesWidget;
use App\Filament\Widgets\PedidosRecentesWidget;
use App\Filament\Widgets\ProdutosEstoqueBaixoWidget;
use App\Filament\Widgets\StatsAdminOverview;
use App\Filament\Widgets\StatsEstoqueOverview;
use App\Filament\Widgets\StatsGerenteOverview;
use App\Filament\Widgets\StatsLogisticaOverview;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\AccountWidget;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Dashboard';

    protected static ?string $title = 'Dashboard';

    public function getWidgets(): array
    {
        $user = auth()->user();

        if ($user?->hasRole('Admin')) {
            return [
                StatsAdminOverview::class,
                PedidosRecentesWidget::class,
                GraficoPedidosMensais::class,
            ];
        }

        if ($user?->hasRole('Gerente')) {
            return [
                StatsGerenteOverview::class,
                PedidosRecentesWidget::class,
                GraficoPedidosMensais::class,
            ];
        }

        if ($user?->hasRole('Logistica')) {
            return [
                StatsLogisticaOverview::class,
                PedidosPendentesWidget::class,
            ];
        }

        if ($user?->hasRole('Estoque')) {
            return [
                StatsEstoqueOverview::class,
                ProdutosEstoqueBaixoWidget::class,
            ];
        }

        return [
            AccountWidget::class,
        ];
    }
}
