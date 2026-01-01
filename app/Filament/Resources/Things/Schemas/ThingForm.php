<?php

namespace App\Filament\Resources\Things\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Enums\ThingCategory;

class ThingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('category')
                ->label('Category')
                ->options(ThingCategory::options())
                ->required()
            ]);
    }
}