<?php

namespace App\Filament\Resources\Insumos;

use App\Filament\Resources\Insumos\Pages\CreateInsumo;
use App\Filament\Resources\Insumos\Pages\EditInsumo;
use App\Filament\Resources\Insumos\Pages\ListInsumos;
use App\Filament\Resources\Insumos\Pages\ViewInsumo;
use App\Filament\Resources\Insumos\Schemas\InsumoInfolist;
use App\Models\Insumo;
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

class InsumoResource extends Resource
{
    protected static ?string $model = Insumo::class;

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBeaker;

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Insumo';

    protected static ?string $pluralModelLabel = 'Insumos';

    protected static ?string $navigationLabel = 'Insumos';

    protected static ?string $recordTitleAttribute = 'nome';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('insumos.ver') ?? false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('insumos.criar') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('insumos.editar') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('insumos.deletar') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('insumos.deletar') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('nome')
                ->label('Nome do Insumo')
                ->required(),
            Select::make('unidade_medida')
                ->label('Unidade de Medida')
                ->required()
                ->options([
                    'UN' => 'Unidade (UN)',
                    'MT' => 'Metro (MT)',
                    'KG' => 'Quilograma (KG)',
                    'CM' => 'Centímetro (CM)',
                    'RL' => 'Rolo (RL)',
                    'PC' => 'Peça (PC)',
                    'DZ' => 'Dúzia (DZ)',
                ])
                ->native(false)
                ->searchable(),
            TextInput::make('preco_custo')
                ->label('Preço de Custo')
                ->numeric()
                ->prefix('R$'),
            TextInput::make('estoque')
                ->label('Quantidade em Estoque')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InsumoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nome')
                    ->label('Insumo')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('unidade_medida')
                    ->label('Un.')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'UN' => 'Unidade',
                        'MT' => 'Metro',
                        'KG' => 'Quilograma',
                        'CM' => 'Centímetro',
                        'RL' => 'Rolo',
                        'PC' => 'Peça',
                        'DZ' => 'Dúzia',
                        default => $state,
                    }),
                TextColumn::make('preco_custo')
                    ->label('Custo')
                    ->money('BRL'),
                TextColumn::make('estoque')
                    ->label('Estoque')
                    ->numeric(decimalPlaces: 2),
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
            'index' => ListInsumos::route('/'),
            'create' => CreateInsumo::route('/create'),
            'view' => ViewInsumo::route('/{record}'),
            'edit' => EditInsumo::route('/{record}/edit'),
        ];
    }
}
