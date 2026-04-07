<?php

namespace App\Filament\Resources\Permissions;

use App\Filament\Resources\Permissions\Pages\CreatePermission;
use App\Filament\Resources\Permissions\Pages\EditPermission;
use App\Filament\Resources\Permissions\Pages\ListPermissions;
use App\Filament\Resources\Permissions\Pages\ViewPermission;
use App\Filament\Resources\Permissions\Schemas\PermissionForm;
use App\Filament\Resources\Permissions\Schemas\PermissionInfolist;
use App\Filament\Resources\Permissions\Tables\PermissionsTable;
// use App\Models\Permission;
use Spatie\Permission\Models\Permission;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class PermissionResource extends Resource
{
    protected static ?string $model = Permission::class;

    public static function canAccess() : bool {
        return auth()->user()?->hasRole('Admin') ?? false;
    } 
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static ?string $modelLabel = 'Permissão';

    public static ?string $navigationLabel = 'Permissão';

    public static ?string $pluralModelLabel = 'Permissões';

    public static string|UnitEnum|null $navigationGroup = 'Administração';

    protected static ?string $recordTitleAttribute = 'Permissões';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
            ->label("Nome da Permissão")
            ->required()
            ->unique(ignoreRecord:true)
            ->maxLength(255)
            ->columnSpanFull()
            ,
            TextInput::make('guard_name')
            ->label('Nível da Permissão')
            ->required()
            ->maxLength(64)
            ->columnSpanFull()
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PermissionInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
            ->label("Nome da permissão")
            ->searchable()
            ->sortable(),
            TextColumn::make('guard_name')
            ->label("Nivel da permissão")
            ->searchable()
            ->sortable(),
            TextColumn::make("created_at")
            ->label("Criada em")
            ->datetime('d/m/Y')
            ->sortable()
        ])->recordActions([
                ViewAction::make()->label("Ver"),
                EditAction::make()->label("Editar")
            ]);;
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
            'index' => ListPermissions::route('/'),
            'create' => CreatePermission::route('/create'),
            'view' => ViewPermission::route('/{record}'),
            'edit' => EditPermission::route('/{record}/edit'),
        ];
    }
}
