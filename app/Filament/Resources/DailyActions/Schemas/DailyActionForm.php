<?php

namespace App\Filament\Resources\DailyActions\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use App\Models\Thing;

class DailyActionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('action_id')
                    ->label('Action')
                    ->relationship('action', 'name')
                    ->required()
                    ->searchable(), // searchable dropdown for many actions

                Select::make('subject_id')
                    ->label('Thing')
                    ->options(Thing::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Hidden::make('subject_type')
                    ->default(Thing::class),

                DatePicker::make('action_date')
                    ->label('Date')
                    ->required()
                    ->default(now()),

                TextInput::make('length')
                    ->label('Length')
                    ->placeholder('e.g., 30 minutes')
                    ->maxLength(255),

                Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->placeholder('Optional notes'),
            ]);
    }
}
