<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Note;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\Book;
use App\Models\Action;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), 
        ]);

        Tag::factory()->count(10)->create();
        Topic::factory()->count(25)->create();
        Note::factory()->count(30)->create();

        $actions = [
            ['name' => 'Reading', 'description' => 'Reading books, articles, or other materials'],
            ['name' => 'Watching', 'description' => 'Watching films, TV, or videos'],
            ['name' => 'Listening', 'description' => 'Listening to music, podcasts, or audio content'],
            ['name' => 'Exercise', 'description' => 'Physical activity like running, Zumba, gym, etc.'],
            ['name' => 'Learning', 'description' => 'Learning a skill or taking a course'],
            ['name' => 'Working', 'description' => 'Work-related tasks and projects'],
            ['name' => 'Socializing', 'description' => 'Social events, gatherings, or meetups'],
            ['name' => 'Admin', 'description' => 'Administrative tasks, emails, bills, chores'],
            ['name' => 'Meditation', 'description' => 'Mindfulness or meditation practices'],
            ['name' => 'Writing', 'description' => 'Journaling or creative writing'],
        ];

        foreach ($actions as $action) {
            Action::updateOrCreate(
                ['name' => $action['name']],
                ['description' => $action['description']]
            );
        }
    }
}
