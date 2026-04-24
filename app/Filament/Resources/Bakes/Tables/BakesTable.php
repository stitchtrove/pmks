<?php

namespace App\Filament\Resources\Bakes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\ReplicateAction;

class BakesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('type')
                    ->searchable(),
                TextColumn::make('subtype')
                    ->searchable(),
                TextColumn::make('published'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('published')
                    ->options([
                        '0' => 'Draft',
                        '1' => 'Published',
                    ]),
                SelectFilter::make('type')
                    ->options([
                        'bread' => 'Bread',
                        'cookie' => 'Cookie',
                        'cake' => 'Cake',
                    ]),
                SelectFilter::make('subtype')
                    ->options([
                        'sourdough' => 'Sourdough',
                        'baguette' => 'Baguette',
                        'bagel' => 'Bagel',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
                ReplicateAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $baseTitle = preg_replace('/ \(Copy.*\)$/', '', $data['name']);
                        $data['name'] = $baseTitle . ' (Copy)';
                        return $data;
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
