<?php

namespace App\Filament\Resources\Flour\Pages;

use App\Filament\Resources\Flour\FlourResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditFlour extends EditRecord
{
    protected static string $resource = FlourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
