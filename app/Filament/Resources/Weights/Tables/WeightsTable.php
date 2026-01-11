<?php

namespace App\Filament\Resources\Weights\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables;

class WeightsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                ->label('Date')
                ->date()
                ->sortable(),

            Tables\Columns\TextColumn::make('weight')
                ->label('Weight')
                ->suffix(' lbs')
                ->sortable(),

            Tables\Columns\TextColumn::make('difference')
                ->label('Change')
                ->suffix(' lbs')
                ->color(fn ($state) =>
                    $state > 0 ? 'danger' : 'success'
                ),

            Tables\Columns\TextColumn::make('bmi')
                ->label('BMI')
                ->sortable(),
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
