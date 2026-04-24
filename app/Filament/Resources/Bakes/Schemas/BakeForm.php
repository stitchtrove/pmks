<?php

namespace App\Filament\Resources\Bakes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
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
                Select::make('flours')
                    ->relationship('flours', 'name')
                    ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->name} ({$record->shop})")
                    ->multiple()
                    ->searchable()
                    ->preload(),
                DateTimePicker::make('created_at')
                    ->label('Baked at')
                    ->default(now())
                    ->required(),
                RichEditor::make('content')
                    ->required()
                     ->floatingToolbars([
                        'paragraph' => [
                            'bold', 'italic', 'underline', 'strike', 'link', 'attachFiles'
                        ]
                    ])
                    ->fileAttachmentsDisk('do')
                    ->fileAttachmentsDirectory('bakes')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),
                FileUpload::make('image_path')->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->disk('do')->maxSize(10240)
                    ->directory('bakes')
                    ->label('Featured Image')
                    ->columnSpanFull(),
                Toggle::make('published')
                    ->label('Published')
                    ->onColor('success')
                    ->offColor('danger')
                    ->default(false)
            ]);
    }
}
