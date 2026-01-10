<?php

namespace App\Filament\Resources\BookReadings\Pages;

use App\Filament\Resources\BookReadings\BookReadingsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBookReadings extends EditRecord
{
    protected static string $resource = BookReadingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
