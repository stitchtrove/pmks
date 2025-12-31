<?php

namespace App\Filament\Resources\Things\Pages;

use App\Filament\Resources\Things\ThingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateThing extends CreateRecord
{
    protected static string $resource = ThingResource::class;
}
