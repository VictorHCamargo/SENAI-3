<?php

namespace App\Filament\Resources\Fornecedors;

use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Pages\ViewFornecedor;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorInfolist;
use App\Models\Fornecedor;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Support\RawJs;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use UnitEnum;

class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedor::class;

    protected static string|UnitEnum|null $navigationGroup = 'Estoque';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;

    protected static ?int $navigationSort = 6;

    protected static ?string $modelLabel = 'Fornecedor';

    protected static ?string $pluralModelLabel = 'Fornecedores';

    protected static ?string $navigationLabel = 'Fornecedores';

    protected static ?string $recordTitleAttribute = 'razao_social';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('fornecedores.ver') ?? false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('fornecedores.criar') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('fornecedores.editar') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('fornecedores.deletar') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('fornecedores.deletar') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('razao_social')
                ->label('Razão Social')
                ->required()
                ->maxLength(255),
            TextInput::make('nome_fantasia')
                ->label('Nome Fantasia')
                ->maxLength(255),
            TextInput::make('documento')
                ->label('CPF ou CNPJ')
                ->required()
                ->live(onBlur: true)
                ->mask(RawJs::make(<<<'JS'
                    $input.length > 14 ? '99.999.999/9999-99' : '999.999.999-99'
                JS))
                ->unique(ignoreRecord: true),
            TextInput::make('inscricao_estadual')
                ->label('Inscrição Estadual')
                ->hidden(function ($get) {
                    $doc = $get('documento');

                    if (blank($doc)) {
                        return true;
                    }

                    return strlen(preg_replace('/\D/', '', $doc)) <= 11;
                }),
            TextInput::make('email')
                ->label('E-mail')
                ->email(),
            TextInput::make('telefone(WhatsApp)')
                ->label('Telefone (WhatsApp)')
                ->tel()
                ->mask('(99) 99999-9999'),
            TextInput::make('endereco')
                ->label('Endereço Completo'),
            Select::make('tipo_material')
                ->label('Tipo de Material')
                ->options(static::tipoMaterialOptions())
                ->default('outros')
                ->native(false),
            Toggle::make('ativo')
                ->label('Fornecedor Ativo')
                ->default(true),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FornecedorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('razao_social')
                    ->label('Razão Social')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nome_fantasia')
                    ->label('Nome Fantasia')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('documento')
                    ->label('CPF/CNPJ')
                    ->searchable(),
                TextColumn::make('tipo_material')
                    ->label('Tipo de Material')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn (string $state): string => static::tipoMaterialOptions()[$state] ?? $state),
                TextColumn::make('telefone(WhatsApp)')
                    ->label('WhatsApp')
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('ativo')
                    ->label('Ativo')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Criado em')
                    ->dateTime('d/m/Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('ativo')
                    ->label('Apenas Ativos'),
                SelectFilter::make('tipo_material')
                    ->label('Tipo de Material')
                    ->options(static::tipoMaterialOptions()),
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
            'index' => ListFornecedors::route('/'),
            'create' => CreateFornecedor::route('/create'),
            'view' => ViewFornecedor::route('/{record}'),
            'edit' => EditFornecedor::route('/{record}/edit'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function tipoMaterialOptions(): array
    {
        return [
            'tecidos' => 'Tecidos',
            'aviamentos' => 'Aviamentos',
            'servicos' => 'Serviços (Facção)',
            'maquinario' => 'Maquinário',
            'outros' => 'Outros',
        ];
    }
}
