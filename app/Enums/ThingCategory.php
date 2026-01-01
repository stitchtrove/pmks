<?php

namespace App\Enums;

enum ThingCategory: string
{
    case Exercise = 'exercise';
    case Book = 'book';
    case Film = 'film';
    case Tv = 'tv';
    case Music = 'music';
    case Learning = 'learning';
    case Work = 'work';
    case Social = 'social';
    case Admin = 'admin';
    case PubJob = 'pubjob';
    case Writing = 'writing';
    case Game = 'game';
    case Baking = 'baking';

    public static function options(): array
    {
        return array_column(
            array_map(fn($case) => ['value' => $case->value, 'label' => $case->name], self::cases()),
            'label',
            'value'
        );
    }
}

