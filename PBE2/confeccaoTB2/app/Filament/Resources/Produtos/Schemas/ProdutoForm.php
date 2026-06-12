<?php

namespace App\Filament\Resources\Produtos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProdutoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required(),
                TextInput::make('referencia')
                    ->label('Referência/SKU'),
                TextInput::make('preco_venda')
                    ->label('Preço de Venda')
                    ->numeric(),
                TextInput::make('estoque')
                    ->label('Quantidade em Estoque')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
