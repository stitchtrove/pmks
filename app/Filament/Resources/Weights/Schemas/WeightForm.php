<?php

namespace App\Filament\Resources\Weights\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Forms\Components;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\FileUpload;

class WeightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    Forms\Components\TextInput::make('weight')
                        ->label('Weight (lbs)')
                        ->numeric()
                        ->step(0.01)
                        ->required()
                        ->minValue(50)
                        ->maxValue(600)
                        ->suffix('lbs')
                        ->helperText('Enter your current weight'),
                    // come back to these when image uploads are supported properly
                    // Forms\Components\FileUpload::make('front_picture_url')
                    //     ->label('Front')
                    //     ->image()
                    //     ->directory('weights')
                    //     ->visibility('private')
                    //     ->imageEditor(),

                    // Forms\Components\FileUpload::make('side_picture_url')
                    //     ->label('Side')
                    //     ->image()
                    //     ->directory('weights')
                    //     ->visibility('private')
                    //     ->imageEditor(),

                    // Forms\Components\FileUpload::make('back_picture_url')
                    //     ->label('Back')
                    //     ->image()
                    //     ->directory('weights')
                    //     ->visibility('private')
                    //     ->imageEditor(),
            ]);
    }
}
