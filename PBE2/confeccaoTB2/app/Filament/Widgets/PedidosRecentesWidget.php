<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PedidosRecentesWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Últimos Pedidos')
            ->query(Pedido::query()->with('cliente')->latest()->limit(10))
            ->paginated(false)
            ->columns([
                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pendente' => 'warning',
                        'Em Produção' => 'info',
                        'Para Entrega' => 'success',
                        'Finalizado' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('valor_total')
                    ->label('Valor')
                    ->money('BRL'),
                TextColumn::make('created_at')
                    ->label('Data')
                    ->dateTime('d/m/Y H:i'),
            ]);
    }
}
