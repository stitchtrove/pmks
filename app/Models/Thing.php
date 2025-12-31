<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Database\Factories\ThingFactory;

class Thing extends Model
{
    /** @use HasFactory<ThingFactory> */
    use HasFactory;

    protected $fillable = ['name', 'category'];

    public function dailyActions()
    {
        return $this->morphMany(DailyAction::class, 'subject');
    }
}
