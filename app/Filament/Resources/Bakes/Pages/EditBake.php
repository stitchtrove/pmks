<?php

namespace App\Filament\Resources\Bakes\Pages;

use App\Filament\Resources\Bakes\BakeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBake extends EditRecord
{
    protected static string $resource = BakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
    protected function getFormActions(): array
    {
        return [
            ...parent::getFormActions(), // keeps the default Save button
            DeleteAction::make(),
        ];
    
    }
}
