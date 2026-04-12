<?php

namespace App\Filament\Resources\Flour;

use App\Filament\Resources\Flour\Pages\CreateFlour;
use App\Filament\Resources\Flour\Pages\EditFlour;
use App\Filament\Resources\Flour\Pages\ListFlour;
use App\Filament\Resources\Flour\Schemas\FlourForm;
use App\Filament\Resources\Flour\Tables\FlourTable;
use App\Models\Flour;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FlourResource extends Resource
{
    protected static ?string $model = \App\Models\SubModels\Flour::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return FlourForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FlourTable::configure($table);
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
            'index' => ListFlour::route('/'),
            'create' => CreateFlour::route('/create'),
            'edit' => EditFlour::route('/{record}/edit'),
        ];
    }
}
