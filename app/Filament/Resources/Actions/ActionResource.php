<?php

namespace App\Filament\Resources\Actions;

use App\Filament\Resources\Actions\Pages\CreateAction;
use App\Filament\Resources\Actions\Pages\EditAction;
use App\Filament\Resources\Actions\Pages\ListActions;
use App\Filament\Resources\Actions\Schemas\ActionForm;
use App\Filament\Resources\Actions\Tables\ActionsTable;
use App\Models\Action;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ActionResource extends Resource
{
    protected static ?string $model = Action::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ActionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ActionsTable::configure($table);
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
            'index' => ListActions::route('/'),
            'create' => CreateAction::route('/create'),
            'edit' => EditAction::route('/{record}/edit'),
        ];
    }
}
