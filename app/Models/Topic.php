<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Database\Factories\TopicFactory;

class Topic extends Model
{
    /** @use HasFactory<TopicFactory> */
    use HasFactory;

    protected $fillable = ['name', 'slug', 'description', 'template'];

    protected static function booted(): void
    {
        static::creating(function ($topic) {
            $topic->slug = $topic->slug ?? Str::slug($topic->name);
        });
    }

    /**
     * All notes under this topic.
     *
     * @return HasMany<Note, $this>
     */
    public function notes(): HasMany
    {
        return $this->hasMany(Note::class);
    }
}