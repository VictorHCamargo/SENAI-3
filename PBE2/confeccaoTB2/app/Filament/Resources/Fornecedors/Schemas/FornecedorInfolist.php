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
                TextEntry::make('razao_social')
                    ->label('Razão Social'),
                TextEntry::make('nome_fantasia')
                    ->label('Nome Fantasia')
                    ->placeholder('-'),
                TextEntry::make('documento')
                    ->label('CPF/CNPJ'),
                TextEntry::make('inscricao_estadual')
                    ->label('Inscrição Estadual')
                    ->placeholder('-'),
                TextEntry::make('email')
                    ->label('E-mail')
                    ->placeholder('-'),
                TextEntry::make('telefone(WhatsApp)')
                    ->label('Telefone (WhatsApp)')
                    ->placeholder('-'),
                TextEntry::make('endereco')
                    ->label('Endereço')
                    ->placeholder('-'),
                TextEntry::make('tipo_material')
                    ->label('Tipo de Material')
                    ->badge(),
                IconEntry::make('ativo')
                    ->label('Ativo')
                    ->boolean(),
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
