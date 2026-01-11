<?php

namespace App\Filament\Resources\Weights\Pages;

use App\Filament\Resources\Weights\WeightResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListWeights extends ListRecords
{
    protected static string $resource = WeightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
