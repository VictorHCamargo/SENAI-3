<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProdutoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nome')
                    ->label('Nome'),
                TextEntry::make('referencia')
                    ->label('Referência/SKU')
                    ->placeholder('-'),
                TextEntry::make('preco_venda')
                    ->label('Preço de Venda')
                    ->money('BRL')
                    ->placeholder('-'),
                TextEntry::make('estoque.quantidade')
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
