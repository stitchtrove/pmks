<?php

namespace App\Filament\Resources\BookReadings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class BookReadingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(
                fn (Builder $query) => $query->orderByRaw("
                    CASE 
                        WHEN status = 'reading' THEN 0
                        WHEN status = 'finished' THEN 1
                        ELSE 2
                    END ASC,
                    CASE 
                        WHEN status = 'reading' THEN started_at
                        ELSE finished_at
                    END DESC
                ")
            )
            ->columns([
                TextColumn::make('book.title')->label('Book Title')->sortable()->searchable(),
                TextColumn::make('started_at')->label('Started At')->date()->sortable(),
                TextColumn::make('finished_at')->label('Finished At')->date()->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'reading' => 'Reading',
                        'finished' => 'Finished',
                        default => ucfirst($state),
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'reading' => 'info',
                        'finished' => 'success',
                        default => 'gray',
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                    SelectFilter::make('status')
                        ->label('Status')
                        ->options([
                            'reading' => 'Reading',
                            'finished' => 'Finished',
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
