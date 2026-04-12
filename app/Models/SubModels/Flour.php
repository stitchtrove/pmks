<?php

namespace App\Models\SubModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Flour extends Model 
{
    protected $fillable = ['name', 'shop', 'link', 'type', 'protein'];

    public function bakes()
    {
        return $this->belongsToMany(Bake::class);
    }
    
}