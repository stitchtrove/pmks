<?php

namespace App\Filament\Resources\BookReadings\Pages;

use App\Filament\Resources\BookReadings\BookReadingsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateBookReadings extends CreateRecord
{
    protected static string $resource = BookReadingsResource::class;
}
