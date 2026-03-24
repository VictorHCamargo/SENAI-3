<?php

namespace App\Filament\Resources\Fornecedors;

use App\Filament\Resources\Fornecedors\Pages\CreateFornecedor;
use App\Filament\Resources\Fornecedors\Pages\EditFornecedor;
use App\Filament\Resources\Fornecedors\Pages\ListFornecedors;
use App\Filament\Resources\Fornecedors\Pages\ViewFornecedor;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorForm;
use App\Filament\Resources\Fornecedors\Schemas\FornecedorInfolist;
use App\Filament\Resources\Fornecedors\Tables\FornecedorsTable;
use App\Models\Fornecedor;
use BackedEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Support\RawJs;
use Filament\Tables\Table;

class FornecedorResource extends Resource
{
    protected static ?string $model = Fornecedor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Fornecedores';

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
                    $apenasNumeros = preg_replace('/\D/', '', $doc);

                    return strlen($apenasNumeros) <= 11;
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
                ->options([
                    'tecidos' => 'Tecidos',
                    'aviamentos' => 'Aviamentos',
                    'servicos' => 'Serviços (Facção)',
                    'maquinario' => 'Maquinário',
                    'outros' => 'Outros',
                ])
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
        return FornecedorsTable::configure($table);
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
}
