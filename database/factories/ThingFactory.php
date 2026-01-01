<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThingFactory extends Factory
{
    protected $model = Thing::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true), 
            'category' => $this->faker->randomElement(array_column(ThingCategory::cases(), 'value')),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}