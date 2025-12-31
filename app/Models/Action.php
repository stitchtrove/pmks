<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Database\Factories\ActionFactory;

class Action extends Model 
{
    /** @use HasFactory<ActionFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description'];

    public function dailyActions()
    {
        return $this->hasMany(DailyAction::class);
    }

}