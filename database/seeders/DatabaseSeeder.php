<?php

use App\Models\Profile;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Task;
use App\Models\User;
use Database\Seeders\ProjectSeeder;
use Database\Seeders\TaskSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 5 users
        User::factory(5)->create();

        $this->call([
            ProjectSeeder::class,    
            TaskSeeder::class,         
        ]);
    }
}

User::all()->each(function ($user) {
    Profile::factory()->create(['user_id' => $user->id]);
});

// ProjectSeeder: 2-4 projects per user
User::all()->each(function ($user) {
    Project::factory(rand(2, 4))->create(['user_id' => $user->id]);
});

// TaskSeeder: 3-6 tasks per project
Project::all()->each(function ($project) {
    Task::factory(rand(3, 6))->create(['project_id' => $project->id]);
});


// TagTaskSeeder: 1-3 random tags per task
Task::all()->each(function ($task) {
    $tagIds = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
    $task->tags()->attach($tagIds);
});