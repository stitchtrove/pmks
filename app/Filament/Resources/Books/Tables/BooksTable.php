<?php

namespace App\Filament\Resources\Books\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Title')->sortable()->searchable(),
                TextColumn::make('authors')->label('Author')->sortable()->searchable(),
                TextColumn::make('number_of_pages')->label('Number of Pages')->sortable(),
                TextColumn::make('isbn')->label('ISBN')->sortable()->searchable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
            ])
            ->filters([
                 SelectFilter::make('status')
                    ->options([
                        'wishlist' => 'Wishlist',
                        'tbr' => 'To Be Read',
                        'reading' => 'Reading',
                        'read' => 'Read',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
