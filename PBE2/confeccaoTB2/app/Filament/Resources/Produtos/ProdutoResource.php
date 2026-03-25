<?php

namespace App\Filament\Resources\Produtos;

use App\Filament\Resources\Produtos\Pages\CreateProduto;
use App\Filament\Resources\Produtos\Pages\EditProduto;
use App\Filament\Resources\Produtos\Pages\ListProdutos;
use App\Filament\Resources\Produtos\Pages\ViewProduto;
use App\Filament\Resources\Produtos\Schemas\ProdutoForm;
use App\Filament\Resources\Produtos\Schemas\ProdutoInfolist;
use App\Filament\Resources\Produtos\Tables\ProdutosTable;
use App\Models\Produto;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Produtos';

    public static function form(Schema $schema): Schema
    {
       return $schema->schema([
            TextInput::make('nome')
                ->required()
                ->label("Nome do Produto"),
                
            TextInput::make("referencia")
                ->label("Referência/SKU"),
                
            TextInput::make("preco_venda")
                ->numeric()
                ->label("Preço de Venda")
                ->prefix('R$'),
                
            TextInput::make("estoque")
                ->integer()
                ->label("Estoque Atual")
                ->default(0),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProdutoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
                TextColumn::make("nome")->searchable()->label("Produto"),
                TextColumn::make("referencia")->searchable()->label("Ref."),
                TextColumn::make("preco_venda")
                    ->money('BRL')
                    ->label("Preço"),
                TextColumn::make("estoque")
                    ->badge() 
                    ->color(fn (int $state): string => $state <= 5 ? 'danger' : 'success')
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
            'index' => ListProdutos::route('/'),
            'create' => CreateProduto::route('/create'),
            'view' => ViewProduto::route('/{record}'),
            'edit' => EditProduto::route('/{record}/edit'),
        ];
    }
}
