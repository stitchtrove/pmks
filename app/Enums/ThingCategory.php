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
    case Meditation = 'meditation';
    case Writing = 'writing';

    public static function options(): array
    {
        return array_column(
            array_map(fn($case) => ['value' => $case->value, 'label' => $case->name], self::cases()),
            'label',
            'value'
        );
    }
}

