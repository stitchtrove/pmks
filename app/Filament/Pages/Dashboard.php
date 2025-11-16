<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getColumns(): int | array
    {
        return [
            'sm' => 1,   // mobile: 1 column
            'md' => 4,   // tablet: 4 columns (half width with span 2)
            'xl' => 6,   // desktop: 6 columns (third width with span 2)
        ];
    }
}