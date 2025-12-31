<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActionFactory extends Factory
{
    public function definition()
    {
        $verbs = [
            'Reading',
            'Watching',
            'Listening',
            'Exercise',
            'Learning',
            'Working',
            'Socializing',
            'Admin',
            'Meditation',
            'Writing',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($verbs),
            'description' => $this->faker->sentence(),
        ];
    }
}