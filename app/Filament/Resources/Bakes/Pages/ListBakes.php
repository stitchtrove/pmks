<?php

namespace App\Filament\Resources\Bakes\Pages;

use App\Filament\Resources\Bakes\BakeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBakes extends ListRecords
{
    protected static string $resource = BakeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
