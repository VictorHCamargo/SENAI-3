<?php

namespace App\Filament\Resources\Pedidos;

use App\Filament\Resources\Pedidos\Pages\CreatePedido;
use App\Filament\Resources\Pedidos\Pages\EditPedido;
use App\Filament\Resources\Pedidos\Pages\ListPedidos;
use App\Filament\Resources\Pedidos\Pages\ViewPedido;
use App\Filament\Resources\Pedidos\Schemas\PedidoInfolist;
use App\Models\Pedido;
use BackedEnum;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?int $navigationSort = 2;

    protected static ?string $modelLabel = 'Pedido';

    protected static ?string $pluralModelLabel = 'Pedidos';

    protected static ?string $navigationLabel = 'Pedidos';

    protected static ?string $recordTitleAttribute = 'id';

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('pedidos.ver') ?? false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('pedidos.criar') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('pedidos.editar') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('pedidos.deletar') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('pedidos.deletar') ?? false;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Select::make('cliente_id')
                ->label('Cliente')
                ->relationship('cliente', 'nome')
                ->searchable()
                ->preload()
                ->required(),
            Select::make('status')
                ->label('Status')
                ->options(static::statusOptions())
                ->default('Pendente')
                ->required(),
            TextInput::make('valor_total')
                ->label('Valor Total')
                ->numeric()
                ->prefix('R$')
                ->readOnly(),
            Repeater::make('itens')
                ->label('Produtos do Pedido')
                ->relationship('itens')
                ->schema([
                    Select::make('produto_id')
                        ->label('Produto')
                        ->relationship('produto', 'nome')
                        ->searchable()
                        ->preload()
                        ->required()
                        ->columnSpan(2),
                    TextInput::make('quantidade')
                        ->label('Quantidade')
                        ->numeric()
                        ->default(1)
                        ->required()
                        ->columnSpan(1)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set)),
                    TextInput::make('preco_unitario')
                        ->label('Preço Unitário')
                        ->numeric()
                        ->prefix('R$')
                        ->required()
                        ->columnSpan(1),
                ])
                ->columnSpan(4)
                ->columnSpanFull()
                ->live()
                ->afterStateUpdated(fn (Get $get, Set $set) => self::calcularTotal($get, $set)),
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PedidoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('cliente.nome')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Pendente' => 'warning',
                        'Em Produção' => 'info',
                        'Para Entrega' => 'success',
                        'Finalizado' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('valor_total')
                    ->label('Valor Total')
                    ->money('BRL')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Data do Pedido')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options(static::statusOptions()),
                Filter::make('created_at')
                    ->label('Data do Pedido')
                    ->schema([
                        DatePicker::make('de')->label('De'),
                        DatePicker::make('ate')->label('Até'),
                    ])
                    ->query(fn ($query, array $data) => $query
                        ->when($data['de'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '>=', $date))
                        ->when($data['ate'] ?? null, fn ($query, $date) => $query->whereDate('created_at', '<=', $date))),
            ])
            ->filtersLayout(FiltersLayout::AboveContent)
            ->recordActions([
                ViewAction::make()->label('Ver'),
                EditAction::make()->label('Editar'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('alterar_status')
                        ->label('Alterar Status')
                        ->schema([
                            Select::make('status')
                                ->label('Novo Status')
                                ->options(static::statusOptions())
                                ->required(),
                        ])
                        ->action(fn ($records, array $data) => $records->each->update(['status' => $data['status']]))
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make()->label('Excluir Selecionados'),
                ]),
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
            'index' => ListPedidos::route('/'),
            'create' => CreatePedido::route('/create'),
            'view' => ViewPedido::route('/{record}'),
            'edit' => EditPedido::route('/{record}/edit'),
        ];
    }

    /**
     * @return array<string, string>
     */
    public static function statusOptions(): array
    {
        return [
            'Pendente' => 'Pendente',
            'Em Produção' => 'Em Produção',
            'Para Entrega' => 'Para Entrega',
            'Finalizado' => 'Finalizado',
        ];
    }

    public static function calcularTotal(Get $get, Set $set): void
    {
        $itens = $get('itens') ?? [];
        $total = 0;

        foreach ($itens as $item) {
            $quantidade = (float) ($item['quantidade'] ?? 0);
            $preco = (float) ($item['preco_unitario'] ?? 0);

            $total += $quantidade * $preco;
        }

        $set('valor_total', number_format($total, 2, '.', ''));
    }
}
