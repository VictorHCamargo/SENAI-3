<?php

namespace App\Filament\Resources\Fornecedors\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class FornecedorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('razao_social')
                    ->required(),
                TextInput::make('nome_fantasia'),
                TextInput::make('documento')
                    ->required(),
                TextInput::make('inscricao_estadual'),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('telefone(WhatsApp)')
                    ->tel(),
                TextInput::make('endereco'),
                Select::make('tipo_material')
                    ->options([
            'tecidos' => 'Tecidos',
            'aviamentos' => 'Aviamentos',
            'servicos' => 'Servicos',
            'maquinario' => 'Maquinario',
            'outros' => 'Outros',
        ])
                    ->default('outros')
                    ->required(),
                Toggle::make('ativo')
                    ->required(),
            ]);
    }
}
