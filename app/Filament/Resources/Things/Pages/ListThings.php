<?php

namespace App\Filament\Resources\Things\Pages;

use App\Filament\Resources\Things\ThingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThings extends ListRecords
{
    protected static string $resource = ThingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
