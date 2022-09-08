<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'icon' => fake()->image(null, $width = 100, $height = 100),
            'name' => fake()->words(random_int(1,3), true),
            'description' => fake()->words(random_int(10,20), true)
        ];
    }
}
