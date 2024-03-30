<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
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
        $user = User::inRandomOrder()->first();
        return [
            'user_id'=>$user->id,
            'title' => $this->faker->sentence,
            'project_image'=>$this->faker->imageUrl(500,300),
            'description'=>$this->faker->paragraph,
            'status' => 'available',
            'student' => 'null',
        ];
    }
}
