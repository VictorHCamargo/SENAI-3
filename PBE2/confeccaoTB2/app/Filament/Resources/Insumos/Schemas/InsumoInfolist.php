<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InsumoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome')
                    ->label('Nome'),
                TextEntry::make('unidade_medida')
                    ->label('Unidade de Medida'),
                TextEntry::make('preco_custo')
                    ->label('Preço de Custo')
                    ->money('BRL')
                    ->placeholder('-'),
                TextEntry::make('estoque')
                    ->label('Quantidade em Estoque')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
