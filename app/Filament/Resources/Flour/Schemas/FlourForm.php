<?php

namespace App\Filament\Resources\Flour\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class FlourForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('shop'),
                TextInput::make('link'),
                TextInput::make('type'),
                TextInput::make('protein'),
            ]);
    }
}
