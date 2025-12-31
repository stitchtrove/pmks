<?php

namespace App\Filament\Resources\Things\Pages;

use App\Filament\Resources\Things\ThingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditThing extends EditRecord
{
    protected static string $resource = ThingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
