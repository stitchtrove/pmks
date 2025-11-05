<?php

namespace App\Models;

use Database\Factories\TagFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    /** @use HasFactory<TagFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug'];

    protected static function booted(): void
    {
        static::creating(function ($tag) {
            $tag->slug = $tag->slug ?? Str::slug($tag->name);
        });
    }

    /**
     * All notes that have this tag.
     *
     * @return BelongsToMany<Note, $this>
     */
    public function notes(): BelongsToMany
    {
        return $this->belongsToMany(Note::class);
    }
}