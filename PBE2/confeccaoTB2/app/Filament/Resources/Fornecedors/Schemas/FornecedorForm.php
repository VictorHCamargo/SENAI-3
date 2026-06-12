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
                    ->label('Razão Social')
                    ->required(),
                TextInput::make('nome_fantasia')
                    ->label('Nome Fantasia'),
                TextInput::make('documento')
                    ->label('CPF ou CNPJ')
                    ->required(),
                TextInput::make('inscricao_estadual')
                    ->label('Inscrição Estadual'),
                TextInput::make('email')
                    ->label('E-mail')
                    ->email(),
                TextInput::make('telefone(WhatsApp)')
                    ->label('Telefone (WhatsApp)')
                    ->tel(),
                TextInput::make('endereco')
                    ->label('Endereço'),
                Select::make('tipo_material')
                    ->label('Tipo de Material')
                    ->options([
            'tecidos' => 'Tecidos',
            'aviamentos' => 'Aviamentos',
            'servicos' => 'Serviços',
            'maquinario' => 'Maquinário',
            'outros' => 'Outros',
        ])
                    ->default('outros')
                    ->required(),
                Toggle::make('ativo')
                    ->label('Ativo')
                    ->required(),
            ]);
    }
}
