<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\About>
 */
class AboutFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            ['logo' => fake()->image()],
            ['profil' => fake()->words(5, true)],
            ['visi' => fake()->words(1, true)],
            ['misi' => fake()->words(10, true)],
            ['struktur_organisasi' => fake()->imageUrl($width=1024, $height=1024)],
            ['sop' => fake()->words(10, true)],
        ];
    }
}
