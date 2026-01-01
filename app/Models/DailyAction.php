<?php

namespace App\Models;

use Database\Factories\DailyActionFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DailyAction extends Model
{
    /** @use HasFactory<DailyActionFactory> */
    use HasFactory;

    protected $fillable = [
        'action_id',
        'subject_id',
        'subject_type',
        'action_date',
        'length',
        'notes',
    ];

    protected $casts = [
        'action_date' => 'date',
    ];

    public function action()
    {
        return $this->belongsTo(Action::class);
    }

    public function subject()
    {
        return $this->morphTo();
    }
}
