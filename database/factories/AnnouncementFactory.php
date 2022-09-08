<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Annoucement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->words(5, true),
            'start_date' => fake()->dateTimeBetween('-2 months'),
            'end_date' => fake()->dateTimeBetween('-1 months'),
        ];
    }
}
