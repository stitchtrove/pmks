<?php

namespace App\Filament\Resources\DailyActions;

use App\Filament\Resources\DailyActions\Pages\CreateDailyAction;
use App\Filament\Resources\DailyActions\Pages\EditDailyAction;
use App\Filament\Resources\DailyActions\Pages\ListDailyActions;
use App\Filament\Resources\DailyActions\Schemas\DailyActionForm;
use App\Filament\Resources\DailyActions\Tables\DailyActionsTable;
use App\Models\DailyAction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DailyActionResource extends Resource
{
    protected static ?string $model = DailyAction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DailyActionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DailyActionsTable::configure($table);
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
            'index' => ListDailyActions::route('/'),
            'create' => CreateDailyAction::route('/create'),
            'edit' => EditDailyAction::route('/{record}/edit'),
        ];
    }
}
