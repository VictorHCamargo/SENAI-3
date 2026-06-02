<?php

namespace App\Filament\Resources\Insumos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InsumoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nome')
                    ->label('Nome')
                    ->required(),
                TextInput::make('unidade_medida')
                    ->label('Unidade de Medida')
                    ->required(),
                TextInput::make('preco_custo')
                    ->label('Preço de Custo')
                    ->numeric(),
                TextInput::make('estoque')
                    ->label('Quantidade em Estoque')
                    ->required()
                    ->numeric()
                    ->default(0.0),
            ]);
    }
}
