<?php

namespace App\Filament\Widgets;

use App\Models\Estoque;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class ProdutosEstoqueBaixoWidget extends TableWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Produtos com Estoque Baixo')
            ->query(
                Estoque::query()
                    ->with('produto')
                    ->where('quantidade', '<=', 10)
                    ->orderBy('quantidade')
            )
            ->defaultPaginationPageOption(10)
            ->columns([
                TextColumn::make('produto.nome')
                    ->label('Produto')
                    ->searchable(),
                TextColumn::make('produto.referencia')
                    ->label('Referência'),
                TextColumn::make('quantidade')
                    ->label('Quantidade')
                    ->badge()
                    ->color(fn (int $state): string => $state <= 5 ? 'danger' : 'warning')
                    ->sortable(),
                TextColumn::make('localizacao')
                    ->label('Localização')
                    ->placeholder('Não definida'),
            ]);
    }
}
