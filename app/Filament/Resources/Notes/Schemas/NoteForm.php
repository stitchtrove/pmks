<?php

namespace App\Filament\Resources\Notes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;
use Filament\Forms;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;

class NoteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Group::make([
                    Section::make('Show Details')->schema([
                        TextInput::make('title'),
                        
                        RichEditor::make('content')
                            ->required()
                            ->extraInputAttributes(['style' => 'min-height: 50vh; overflow-y: auto;'])
                            ->columnSpanFull(),
                    ]),
                ])->columnSpan(2)->columns(1),
                Group::make([
                    Section::make('Metadata')->schema([
                        Select::make('topic_id')
                            ->relationship('topic', 'name')
                            ->searchable()
                            ->nullable()
                            ->label('Topic'),

                        Select::make('tags')
                            ->multiple()
                            ->relationship('tags', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->unique('tags', 'name'),
                            ])
                            ->label('Tags'),
                        Select::make('status')
                        ->options([
                            'draft' => 'Draft',
                            'private' => 'Private',
                            'published' => 'Published',
                            'archived' => 'Archived',
                        ])
                            ->required()
                            ->default('draft'),
                        Toggle::make('is_pinned')
                            ->required(),
                        Toggle::make('is_public')
                            ->required(),
                    ]),
                    Section::make('Other')->schema([
                        TextInput::make('uuid')
                            ->label('UUID')
                            ->required(),
                        TextInput::make('slug'),
                        DateTimePicker::make('last_reviewed_at'),
                        TextInput::make('user_id')
                            ->required()
                            ->numeric(),
                        Textarea::make('excerpt')
                            ->columnSpanFull(),
                        TextInput::make('word_count')
                            ->numeric()->readOnly(),
                        TextInput::make('read_time')
                            ->numeric()->readOnly(),
                    ])
                ])->columnSpan(1)->columns(1),
            ])->columns(3);
    }
}
