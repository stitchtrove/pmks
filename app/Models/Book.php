<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Database\Factories\ActionFactory;

class Book extends Model 
{
    /** @use HasFactory<ActionFactory> */
    use HasFactory;

    protected $fillable = ['title', 'authors', 'isbn', 'published_year', 'cover_url', 'number_of_pages', 'rating', 'description', 'publisher', 'status'];

    public function readings()
    {
        return $this->hasMany(BookReading::class);
    }

    public const STATUSES = [
        'wishlist' => 'Wishlist',
        'tbr' => 'To Be Read',
        'reading' => 'Reading',
        'read' => 'Read',
    ];
}