<?php

namespace App\Filament\Resources\Notes\Widgets;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Widgets\Widget;
use App\Models\Note;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use App\Models\Topic;

class QuickCreateNote extends Widget implements HasForms
{
    use InteractsWithForms;

    protected string $view = 'filament.resources.notes.widgets.quick-create-post';

    protected int | string | array $columnSpan = [
        'sm' => 1,      // 1 / 1 = full width
        'md' => 2,      // 2 / 4 = half width
        'xl' => 3,      
    ];

}
