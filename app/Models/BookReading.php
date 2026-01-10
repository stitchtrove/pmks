<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookReading extends Model
{
    protected $fillable = [
        'book_id',
        'started_at',
        'finished_at',
        'format',
        'status',
        'notes',
    ];

    protected $dates = [
        'started_at',
        'finished_at',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}