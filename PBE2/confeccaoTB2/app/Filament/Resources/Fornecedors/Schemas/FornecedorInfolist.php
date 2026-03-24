<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FornecedorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('razao_social'),
                TextEntry::make('nome_fantasia')
                    ->placeholder('-'),
                TextEntry::make('documento'),
                TextEntry::make('inscricao_estadual')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('Email address')
                    ->placeholder('-'),
                TextEntry::make('telefone(WhatsApp)')
                    ->placeholder('-'),
                TextEntry::make('endereco')
                    ->placeholder('-'),
                TextEntry::make('tipo_material')
                    ->badge(),
                IconEntry::make('ativo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
