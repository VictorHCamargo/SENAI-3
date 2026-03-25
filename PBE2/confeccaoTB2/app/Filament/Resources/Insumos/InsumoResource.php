<?php

namespace App\Filament\Resources\Insumos;

use App\Filament\Resources\Insumos\Pages\CreateInsumo;
use App\Filament\Resources\Insumos\Pages\EditInsumo;
use App\Filament\Resources\Insumos\Pages\ListInsumos;
use App\Filament\Resources\Insumos\Pages\ViewInsumo;
use App\Filament\Resources\Insumos\Schemas\InsumoForm;
use App\Filament\Resources\Insumos\Schemas\InsumoInfolist;
use App\Filament\Resources\Insumos\Tables\InsumosTable;
use App\Models\Insumo;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class InsumoResource extends Resource
{
    protected static ?string $model = Insumo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Insumos';

    public static function form(Schema $schema): Schema
    {
       return $schema->schema([
            TextInput::make('nome')
                ->required()
                ->label("Nome do Insumo"),
                
            Select::make("unidade_medida")
                ->required()
                ->label("Unidade de Medida")
                ->options([
                    'UN' => 'Unidade (Un)',
                    'MT' => 'Metro (MT)',
                    'KG' => 'Quilograma (KG)',
                    'CM' => 'Centímetro (CM)',
                    'RL' => 'Rolo (RL)',
                    'PC' => 'Peça (PC)',
                    'DZ' => 'Dúzia (DZ)',
                ])
                ->native(false)
                ->searchable(),
                
            TextInput::make("preco_custo")
                ->numeric()
                ->label("Preço de Custo")
                ->prefix('R$'),
                
            TextInput::make("estoque")
                ->numeric()
                ->label("Quantidade em Estoque")
                ->default(0),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InsumoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make("nome")->searchable()->label("Insumo"),
            TextColumn::make("unidade_medida")->label("Un.")
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'UN' => 'Unidade',
                    'MT' => 'Metro',
                    'KG' => 'Quilograma',
                    default => $state,
                }),
            TextColumn::make("preco_custo")
                ->money('BRL')
                ->label("Custo"),
            TextColumn::make("estoque")
                ->numeric(decimalPlaces: 2)
                ->label("Estoque"),
        ])->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInsumos::route('/'),
            'create' => CreateInsumo::route('/create'),
            'view' => ViewInsumo::route('/{record}'),
            'edit' => EditInsumo::route('/{record}/edit'),
        ];
    }
}
