<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $table = 'weight_update';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'weight',
        'difference',
        'bmi',
        'front_picture_url',
        'side_picture_url',
        'back_picture_url',
    ];

    /**
     * Cast attributes to native types.
     */
    protected $casts = [
        'weight' => 'decimal:2',
        'difference' => 'decimal:2',
        'bmi' => 'decimal:2',
    ];

    // Calculate difference and BMI on creation
    protected static function booted()
    {
        static::creating(function ($weight) {

            $previous = self::orderByDesc('id')->first();

            if ($previous) {
                $weight->difference = bcsub(
                    $weight->weight,
                    $previous->weight,
                    2
                );
            }

            $user = auth()->user();

            if ($user?->height_inches) {
                $height = $user->height_inches;

                $weight->bmi = round(
                    ($weight->weight / ($height * $height)) * 703,
                    2
                );
            }
        });
    }
}
