<?php

namespace App\Filament\Resources\Things;

use App\Filament\Resources\Things\Pages\CreateThing;
use App\Filament\Resources\Things\Pages\EditThing;
use App\Filament\Resources\Things\Pages\ListThings;
use App\Filament\Resources\Things\Schemas\ThingForm;
use App\Filament\Resources\Things\Tables\ThingsTable;
use App\Models\Thing;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ThingResource extends Resource
{
    protected static ?string $model = Thing::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ThingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThingsTable::configure($table);
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
            'index' => ListThings::route('/'),
            'create' => CreateThing::route('/create'),
            'edit' => EditThing::route('/{record}/edit'),
        ];
    }
}
