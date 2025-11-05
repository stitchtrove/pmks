<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        $content = $this->faker->paragraphs(4, true);
        $wordCount = str_word_count(strip_tags($content));

        return [
            'uuid' => (string) Str::uuid(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(4),
            'content' => $content,
            'excerpt' => $this->faker->sentence(20),
            'status' => $this->faker->randomElement(['draft', 'private', 'published', 'archived']),
            'is_pinned' => $this->faker->boolean(10),
            'is_public' => $this->faker->boolean(50),
            'word_count' => $wordCount,
            'read_time' => ceil($wordCount / 200),
            'last_reviewed_at' => $this->faker->optional()->dateTimeBetween('-6 months', 'now'),
            'user_id' => '1', // there'll be only one user for now
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($note) {
            $note->topic()->associate(\App\Models\Topic::inRandomOrder()->first())->save();
            $tags = \App\Models\Tag::inRandomOrder()->take(rand(5, 10))->pluck('id');
            $note->tags()->attach($tags);
        });
    }

}
