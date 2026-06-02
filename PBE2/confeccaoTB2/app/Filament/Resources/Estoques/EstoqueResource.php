<?php

namespace App\Filament\Resources\Estoques;

use App\Filament\Resources\Estoques\Pages\CreateEstoque;
use App\Filament\Resources\Estoques\Pages\EditEstoque;
use App\Filament\Resources\Estoques\Pages\ListEstoques;
use App\Filament\Resources\Estoques\Pages\ViewEstoque;
use App\Filament\Resources\Estoques\Schemas\EstoqueInfolist;
use App\Models\Estoque;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class EstoqueResource extends Resource
{
    protected static ?string $model = Estoque::class;

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?int $navigationSort = 3;

    protected static ?string $modelLabel = 'Item de Estoque';

    protected static ?string $pluralModelLabel = 'Estoque';

    protected static ?string $navigationLabel = 'Estoque';

    protected static ?string $recordTitleAttribute = 'produto_id';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('estoque.ver') ?? false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('estoque.criar') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('estoque.editar') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('estoque.deletar') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('estoque.deletar') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('produto_id')
                ->label('Produto')
                ->relationship('produto', 'nome')
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
        return $table
            ->columns([
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
                    ->icon(fn (int $state): string => $state <= 5 ? 'heroicon-o-exclamation-triangle' : '')
                    ->iconColor('danger')
                    ->color(fn (int $state): string => $state <= 5 ? 'danger' : ($state <= 10 ? 'warning' : 'success')),
                TextColumn::make('localizacao')
                    ->label('Localização')
                    ->searchable()
                    ->placeholder('Não definida'),
                TextColumn::make('updated_at')
                    ->label('Última Atualização')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
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
            'index' => ListEstoques::route('/'),
            'create' => CreateEstoque::route('/create'),
            'view' => ViewEstoque::route('/{record}'),
            'edit' => EditEstoque::route('/{record}/edit'),
        ];
    }
}
