<?php

namespace Database\Factories;

use App\Models\Idea;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'idea_id' => Idea::factory(),
            'user_id' => User::factory(),
            'title' => fake()->sentence(4),
            'summary' => fake()->sentence(),
            'details' => fake()->paragraphs(2, true),
            'status' => 'proposed',
            'proposed_at' => now(),
        ];
    }
}
