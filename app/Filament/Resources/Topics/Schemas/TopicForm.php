<?php

namespace App\Filament\Resources\Topics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Forms\Components\RichEditor;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;

class TopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                RichEditor::make('template')
                            ->extraInputAttributes(['style' => 'min-height: 50vh; overflow-y: auto;'])
                            ->columnSpanFull(),
            ]);
    }
}
