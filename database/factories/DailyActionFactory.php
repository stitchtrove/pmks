<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DailyActionFactory extends Factory
{
    protected $model = DailyAction::class;

    public function definition(): array
    {
        // Get random Action and Thing
        $action = Action::inRandomOrder()->first() ?? Action::factory()->create();
        $thing = Thing::inRandomOrder()->first() ?? Thing::factory()->create();

        return [
            'action_id' => $action->id,
            'subject_id' => $thing->id,
            'subject_type' => Thing::class, // polymorphic
            'action_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'length' => $this->faker->numberBetween(5, 120), // minutes
            'notes' => $this->faker->optional()->sentence(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}