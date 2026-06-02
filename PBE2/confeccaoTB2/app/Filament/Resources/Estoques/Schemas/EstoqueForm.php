<?php

namespace App\Filament\Resources\Estoques\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EstoqueForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('produto_id')
                    ->label('Produto')
                    ->required()
                    ->numeric(),
                TextInput::make('quantidade')
                    ->label('Quantidade')
                    ->required()
                    ->numeric()
                    ->default(1),
                TextInput::make('localizacao')
                    ->label('Localização'),
            ]);
    }
}
