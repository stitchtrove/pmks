<?php

namespace App\Filament\Resources\Books\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use App\Http\Services\OpenLibraryService;
use Filament\Notifications\Notification;
use Filament\Forms\Components\Select;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('isbn')
                    ->label('ISBN')
                    ->reactive()
                    ->debounce(500)
                    ->afterStateUpdated(function (string $state, callable $set) {
                        if (blank($state)) {
                            return;
                        }

                        $service = app(OpenLibraryService::class);
                        $book = $service->getBookByIsbn($state);

                        if (! $book) {
                            Notification::make()
                                ->title('Book not found')
                                ->danger()
                                ->send();

                            return;
                        }

                        $set('title', $book->title);
                        $set('cover_url', $book->coverLarge);
                        $set('number_of_pages', $book->numberOfPages);
                        $set('authors', implode(', ', $book->authors));
                        $set('publisher', implode(', ', $book->publisher));
                    }),

                TextInput::make('title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('authors')
                    ->required()
                    ->label('Author'),

                TextInput::make('number_of_pages')
                    ->label('Number of Pages'),

                TextInput::make('cover_url')
                    ->label('Cover URL')
                    ->maxLength(255),
                
                TextInput::make('publisher')
                    ->label('Publisher')
                    ->maxLength(255),

                TextInput::make('rating')
                    ->label('Rating')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5),

                Select::make('status')
                    ->options([
                        'wishlist' => 'Wishlist',
                        'tbr' => 'To Be Read',
                        'reading' => 'Reading',
                        'read' => 'Read',
                    ])
                    ->default('wishlist')
                    ->required(),


            ]);
    }
}
