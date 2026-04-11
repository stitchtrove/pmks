<?php

namespace App\Filament\Resources\Bakes\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Schema;

class BakeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Select::make('type')
                    ->options([
                        'bread' => 'Bread',
                        'cookie' => 'Cookie',
                        'cake' => 'Cake',
                    ])
                    ->required(),
                Select::make('subtype')
                    ->options([
                        'sourdough' => 'Sourdough',
                        'baguette' => 'Baguette',
                        'bagel' => 'Bagel',
                    ]),
                Select::make('related_bake_id')
                    ->relationship(
                        'relatedBake',
                        'name',
                        fn ($query, $livewire) =>
                            $livewire->record
                                ? $query->where('id', '!=', $livewire->record->id)
                                : $query
                    )->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->created_at->format('d-m-Y')})")
                    ->searchable()
                    ->preload()->placeholder('None')
                    ->nullable(),
                MarkdownEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image_path')
                    ->image()
                    ->columnSpanFull(),
            ]);
    }
}
