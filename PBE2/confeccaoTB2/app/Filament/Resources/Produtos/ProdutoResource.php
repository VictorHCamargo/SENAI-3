<?php

namespace App\Filament\Resources\Produtos;

use App\Filament\Resources\Produtos\Pages\CreateProduto;
use App\Filament\Resources\Produtos\Pages\EditProduto;
use App\Filament\Resources\Produtos\Pages\ListProdutos;
use App\Filament\Resources\Produtos\Pages\ViewProduto;
use App\Filament\Resources\Produtos\Schemas\ProdutoInfolist;
use App\Models\Produto;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTag;

    protected static ?int $navigationSort = 5;

    protected static ?string $modelLabel = 'Produto';

    protected static ?string $pluralModelLabel = 'Produtos';

    protected static ?string $navigationLabel = 'Produtos';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('produtos.ver') ?? false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('produtos.criar') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('produtos.editar') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('produtos.deletar') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('produtos.deletar') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nome')
                ->label('Nome do Produto')
                ->required(),
            TextInput::make('referencia')
                ->label('Referência/SKU'),
            TextInput::make('preco_venda')
                ->label('Preço de Venda')
                ->numeric()
                ->prefix('R$'),
            TextInput::make('estoque.quantidade')
                ->label('Quantidade em Estoque')
                ->numeric()
                ->default(0)
                ->required(),
            TextInput::make('estoque.localizacao')
                ->label('Localização no Depósito'),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdutoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('referencia')
                    ->label('Ref.')
                    ->searchable(),
                TextColumn::make('preco_venda')
                    ->label('Preço')
                    ->money('BRL'),
                TextColumn::make('estoque.quantidade')
                    ->label('Estoque')
                    ->badge()
                    ->placeholder('0')
                    ->color(fn (?int $state): string => ($state ?? 0) <= 5 ? 'danger' : (($state ?? 0) <= 10 ? 'warning' : 'success')),
            ])
            ->recordActions([
                ViewAction::make()->label('Ver'),
                EditAction::make()->label('Editar'),
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
            'index' => ListProdutos::route('/'),
            'create' => CreateProduto::route('/create'),
            'view' => ViewProduto::route('/{record}'),
            'edit' => EditProduto::route('/{record}/edit'),
        ];
    }
}
