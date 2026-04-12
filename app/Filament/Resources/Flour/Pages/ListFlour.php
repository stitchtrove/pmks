<?php

namespace App\Filament\Resources\Flour\Pages;

use App\Filament\Resources\Flour\FlourResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListFlour extends ListRecords
{
    protected static string $resource = FlourResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
