<?php

namespace App\Filament\Resources\Weights;

use App\Filament\Resources\Weights\Pages\CreateWeight;
use App\Filament\Resources\Weights\Pages\EditWeight;
use App\Filament\Resources\Weights\Pages\ListWeights;
use App\Filament\Resources\Weights\Schemas\WeightForm;
use App\Filament\Resources\Weights\Tables\WeightsTable;
use App\Models\Weight;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class WeightResource extends Resource
{
    protected static ?string $model = Weight::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static string | UnitEnum | null $navigationGroup = 'Health';

    protected static ?string $navigationLabel = 'Weight';

    public static function form(Schema $schema): Schema
    {
        return WeightForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return WeightsTable::configure($table);
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
            'index' => ListWeights::route('/'),
            'create' => CreateWeight::route('/create'),
            'edit' => EditWeight::route('/{record}/edit'),
        ];
    }
}
