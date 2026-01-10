<?php

namespace App\Filament\Resources\BookReadings\Pages;

use App\Filament\Resources\BookReadings\BookReadingsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBookReadings extends ListRecords
{
    protected static string $resource = BookReadingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
