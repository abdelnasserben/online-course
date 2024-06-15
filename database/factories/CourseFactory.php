<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'picture' => $this->faker->imageUrl(),
            'short_description' => $this->faker->sentence(rand(10, 20)), // Entre 5 et 10 mots
            'description' => $this->faker->paragraphs(rand(3, 5), true), // Entre 3 et 5 paragraphes
            'topic_id' => rand(1, 5), // Supposez qu'il y ait 5 topics
            'is_premium' => $this->faker->boolean,
            'level' => $this->faker->randomElement(['debutant', 'intermediaire', 'avance']),
        ];
    }
}
