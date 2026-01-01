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
    case PubJob = 'pub_job';
    case Writing = 'writing';
    case Game = 'game';
    case Baking = 'baking';
    case Sewing = 'sewing';
    case CrossStitch = 'cross_stitch';
    case Embroidery = 'embroidery';
    case Knitting = 'knitting';
    case Development = 'development';

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [$case->value => $case->label()])
            ->toArray();
    }

    public function label(): string
    {
        return match ($this) {
            self::Tv => 'TV',
            self::PubJob => 'Pub Job',
            self::CrossStitch => 'Cross Stitch',
            default => ucwords(str_replace('_', ' ', $this->value)),
        };
    }
}

