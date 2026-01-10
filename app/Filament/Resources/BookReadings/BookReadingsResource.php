<?php

namespace App\Filament\Resources\BookReadings;

use App\Filament\Resources\BookReadings\Pages\CreateBookReadings;
use App\Filament\Resources\BookReadings\Pages\EditBookReadings;
use App\Filament\Resources\BookReadings\Pages\ListBookReadings;
use App\Filament\Resources\BookReadings\Schemas\BookReadingsForm;
use App\Filament\Resources\BookReadings\Tables\BookReadingsTable;
use App\Models\BookReading;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class BookReadingsResource extends Resource
{
    protected static ?string $model = BookReading::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookOpen;

    protected static string | UnitEnum | null $navigationGroup = 'Books';

    protected static ?string $navigationLabel = 'Readings';

    public static function form(Schema $schema): Schema
    {
        return BookReadingsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookReadingsTable::configure($table);
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
            'index' => ListBookReadings::route('/'),
            'create' => CreateBookReadings::route('/create'),
            'edit' => EditBookReadings::route('/{record}/edit'),
        ];
    }
}
