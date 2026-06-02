<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PedidosPendentesWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Pedidos Pendentes e em Produção')
            ->query(
                Pedido::query()
                    ->with('cliente')
                    ->whereIn('status', ['Pendente', 'Em Produção'])
                    ->oldest()
            )
            ->defaultPaginationPageOption(10)
            ->columns([
                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Pendente' ? 'warning' : 'info'),
                TextColumn::make('valor_total')
                    ->label('Valor')
                    ->money('BRL'),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ]);
    }
}
