<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Database\Factories\ThingFactory;
use App\Enums\ThingCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thing extends Model
{
    /** @use HasFactory<ThingFactory> */
    use HasFactory;

    protected $fillable = ['name', 'category'];

    protected $casts = [
        'category' => ThingCategory::class,
    ];

    public function dailyActions()
    {
        return $this->morphMany(DailyAction::class, 'subject');
    }
}
