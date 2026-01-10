<?php

namespace App\Filament\Resources\BookReadings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class BookReadingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('book.title')->label('Book Title')->sortable()->searchable(),
                TextColumn::make('started_at')->label('Started At')->date()->sortable(),
                TextColumn::make('finished_at')->label('Finished At')->date()->sortable(),
                TextColumn::make('status')->label('Status')->sortable()->searchable(),
            ])
            ->filters([
                //
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
