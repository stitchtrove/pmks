<?php

namespace App\Livewire;

use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Illuminate\Contracts\View\View;
use Filament\Schemas\Schema;
use Livewire\Component;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use App\Models\Topic;
use App\Models\Note;
use Filament\Notifications\Notification;

/**
 * @property \Filament\Schemas\Schema $form
 */
class CreateNote extends Component implements HasSchemas
{
    use InteractsWithSchemas;
    
    
    public ?array $data = [];
    
    public function mount(): void
    {
        $this->form->fill();
    }
    
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('topic_id')
                ->relationship('topic', 'name')
                ->searchable()
                ->nullable()
                ->label('Topic')
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state, $get) {
                    $content = $get('content');
                    if ($content === null || $content === '<p></p>') {
                        $topic = Topic::find($state);
                        if ($topic?->template) {
                            $set('content', $topic->template);
                        }
                    }
                }),
                TextInput::make('title')->default('Quick Note' . ' ' . now()->format('d/m/y H:i')),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }
    
    public function create(): void
    {
        $data = $this->form->getState();

        $data['user_id'] = auth()->id();

        Note::create($data);

        $this->data = [];
        $this->form->fill();

        Notification::make()
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->title('Note created successfully!')
            ->send();
    }
    
    public function render(): View
    {
        return view('livewire.create-note');
    }
}