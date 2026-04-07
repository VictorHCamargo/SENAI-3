<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function canAccess() : bool {
        return auth()->user()?->hasRole('Admin') ?? false;
    } 
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static ?string $modelLabel = 'Usuário';

    public static ?string $navigationLabel = 'Usuário';

    public static ?string $pluralModelLabel = 'Usuários';

    public static string|UnitEnum|null $navigationGroup = 'Administração';
    protected static ?string $recordTitleAttribute = 'Usuários';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
            ->label("Nome")
            ->required()
            ,
            TextInput::make('email')
            ->label("E-mail")
            ->email()
            ->required()
            ,
            TextInput::make('password')
            ->label('Senha')
            ->password()
            ->required(fn (string $operation):bool => $operation === 'create')
            ->dehydrated(fn (?string $state) => filled($state))
            ->hiddenOn('view')
            ,
            Select::make('roles')
            ->label("Cargos / Permissões")
            ->required()
            ->multiple()
            ->relationship('roles','name')
            ->preload()
            ->columnSpanFull()
        ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return UserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
            ->label("Usuário")
            ->searchable()
            ->sortable(),
            TextColumn::make('email')
            ->label("E-mail")
            ->searchable()
            ->sortable(),
            TextColumn::make('roles.name')
            ->label('Cargos')
            ->searchable()
            ->sortable()
        ])->recordActions([
                ViewAction::make()->label("Ver"),
                EditAction::make()->label("Editar")
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'view' => ViewUser::route('/{record}'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
