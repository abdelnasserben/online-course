<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trainer>
 */
class TrainerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraph,
            'photo' => $this->faker->imageUrl(),
            'github' => $this->faker->userName,
            'linkedin' => $this->faker->userName,
            'twitter' => $this->faker->userName,
            'website' => $this->faker->url,
        ];
    }
}
