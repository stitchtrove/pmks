<?php

namespace App\Filament\Resources\Notes\Widgets;

use Filament\Actions\BulkActionGroup;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Note;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Resources\Notes\NoteResource;

class ListNotes extends TableWidget
{
    protected int | string | array $columnSpan = [
        'sm' => 1,      // 1 / 1 = full width
        'md' => 2,      // 2 / 4 = half width
        'xl' => 3,      
    ];

    public function table(Table $table): Table
    {
        return $table
            ->heading('Most recent notes')
            ->query(fn (): Builder => Note::query()->limit(5)->orderBy('updated_at', 'desc'))
            ->poll('10s')
            ->recordUrl(
                fn (Note $record): string => NoteResource::getUrl('edit', ['record' => $record])
            )
            ->columns([
                TextColumn::make('title'),
            ])
            ->paginated(false)
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }
}
