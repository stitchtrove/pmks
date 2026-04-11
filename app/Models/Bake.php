<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bake extends Model
{
    /** @use HasFactory<\Database\Factories\BakeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'image_path',
        'published',
        'type',
        'subtype',
    ];

    public function relatedBake()
    {
        return $this->belongsTo(Bake::class, 'related_bake_id');
    }
}
