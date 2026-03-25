<?php

namespace App\Filament\Resources\Estoques;

use App\Filament\Resources\Estoques\Pages\CreateEstoque;
use App\Filament\Resources\Estoques\Pages\EditEstoque;
use App\Filament\Resources\Estoques\Pages\ListEstoques;
use App\Filament\Resources\Estoques\Pages\ViewEstoque;
use App\Filament\Resources\Estoques\Schemas\EstoqueForm;
use App\Filament\Resources\Estoques\Schemas\EstoqueInfolist;
use App\Filament\Resources\Estoques\Tables\EstoquesTable;
use App\Models\Estoque;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;

class EstoqueResource extends Resource
{
    protected static ?string $model = Estoque::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Estoques';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('produto_id')
                ->relationship('produto', 'nome')
                ->label('Produto')
                ->searchable()
                ->preload()
                ->required()
                ->createOptionForm([
                    TextInput::make('nome')
                        ->label('Nome do Produto')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('referencia')
                        ->label('Referência/SKU'),
                    TextInput::make('preco_venda')
                        ->label('Preço de Venda')
                        ->numeric()
                        ->prefix('R$'),
                ])
                ->columnSpan(2),

            TextInput::make('quantidade')
                ->label('Quantidade Atual')
                ->numeric()
                ->default(0)
                ->required()
                ->columnSpan(1),

            TextInput::make('localizacao')
                ->label('Localização no Depósito')
                ->placeholder('Ex: Corredor A, Prateleira 2')
                ->columnSpan(1),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EstoqueInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('produto.nome')
                ->label('Produto')
                ->searchable()
                ->sortable(),
            TextColumn::make('produto.referencia')
                ->label('Ref/SKU')
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('quantidade')
                ->label('Qtd. em Estoque')
                ->numeric()
                ->sortable()
                ->color(fn (int $state): string => $state <= 5 ? 'danger' : 'success'),

            TextColumn::make('localizacao')
                ->label('Localização')
                ->searchable()
                ->placeholder('Não definida'),

            TextColumn::make('updated_at')
                ->label('Última Atualização')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
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
            'index' => ListEstoques::route('/'),
            'create' => CreateEstoque::route('/create'),
            'view' => ViewEstoque::route('/{record}'),
            'edit' => EditEstoque::route('/{record}/edit'),
        ];
    }
}
