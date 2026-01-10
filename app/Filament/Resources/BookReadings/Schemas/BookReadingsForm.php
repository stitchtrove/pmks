<?php

namespace App\Filament\Resources\BookReadings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;

class BookReadingsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('book_id')
                    ->label('Book')
                    ->required()
                    ->relationship('book', 'title') 
                    ->searchable() 
                    ->preload(),
                DatePicker::make('started_at')
                    ->label('Started At')
                    ->default(now())
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->required()
                    ->options([
                        'reading' => 'Reading',
                        'finished' => 'Finished',
                    ])
                    ->default('reading'),
                DatePicker::make('finished_at')
                    ->label('Finished At'),
                Select::make('format')
                    ->label('Format')
                    ->options([
                        'physical' => 'Physical',
                        'ebook' => 'eBook',
                        'audiobook' => 'Audiobook',
                    ]),
                Textarea::make('notes')
                    ->label('Notes'),   
            ]);
    }
}
