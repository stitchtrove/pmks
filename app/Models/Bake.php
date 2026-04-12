<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Bake extends Model
{
    /** @use HasFactory<\Database\Factories\BakeFactory> */
    use HasFactory;

    protected $fillable = [
        'slug',
        'name',
        'content',
        'image_path',
        'published',
        'type',
        'subtype',
        'related_bake_id',
    ];

    protected $casts = [
        'published' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($bake) {
            $bake->slug = static::generateSlug($bake->name);
        });
    }

    public function relatedBake()
    {
        return $this->belongsTo(Bake::class, 'related_bake_id');
    }

    public function flours()
    {
        return $this->belongsToMany(\App\Models\SubModels\Flour::class);
    }

    public static function generateSlug($name)
    {
        $base = Str::slug($name);
        $date = now()->format('dmY');
        $slug = "{$base}-{$date}";

        $count = static::where('slug', 'like', "{$slug}%")->count();

        return $count ? "{$slug}-{$count}" : $slug;
    }
}
