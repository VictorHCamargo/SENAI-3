<?php

namespace App\Filament\Resources\Fornecedors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FornecedorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('razao_social')
                    ->label('Razão Social')
                    ->searchable(),
                TextColumn::make('nome_fantasia')
                    ->label('Nome Fantasia')
                    ->searchable(),
                TextColumn::make('documento')
                    ->label('CPF/CNPJ')
                    ->searchable(),
                TextColumn::make('inscricao_estadual')
                    ->label('Inscrição Estadual')
                    ->searchable(),
                TextColumn::make('email')
                    ->label('E-mail')
                    ->searchable(),
                TextColumn::make('telefone(WhatsApp)')
                    ->label('Telefone (WhatsApp)')
                    ->searchable(),
                TextColumn::make('endereco')
                    ->label('Endereço')
                    ->searchable(),
                TextColumn::make('tipo_material')
                    ->label('Tipo de Material')
                    ->badge(),
                IconColumn::make('ativo')
                    ->label('Ativo')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make()->label('Ver'),
                EditAction::make()->label('Editar'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()->label('Excluir Selecionados'),
                ]),
            ]);
    }
}
