<?php

namespace App\Filament\Resources\Bakes;

use App\Filament\Resources\Bakes\Pages\CreateBake;
use App\Filament\Resources\Bakes\Pages\EditBake;
use App\Filament\Resources\Bakes\Pages\ListBakes;
use App\Filament\Resources\Bakes\Schemas\BakeForm;
use App\Filament\Resources\Bakes\Tables\BakesTable;
use App\Models\Bake;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BakeResource extends Resource
{
    protected static ?string $model = Bake::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return BakeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BakesTable::configure($table);
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
            'index' => ListBakes::route('/'),
            'create' => CreateBake::route('/create'),
            'edit' => EditBake::route('/{record}/edit'),
        ];
    }
}
