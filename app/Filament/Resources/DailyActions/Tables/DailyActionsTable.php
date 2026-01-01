<?php

namespace App\Filament\Resources\DailyActions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
class DailyActionsTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([
                TextColumn::make('action.name')->label('Action'),

                TextColumn::make('subject')
                    ->label('Thing')
                    ->getStateUsing(fn ($record) => $record->subject?->name),

                TextColumn::make('subject_category')
                    ->label('Category')
                    ->getStateUsing(fn ($record) => $record->subject?->category),

                TextColumn::make('action_date')->date()->label('Date'),
                TextColumn::make('length')->label('Length'),
                TextColumn::make('notes')->label('Notes'),
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
