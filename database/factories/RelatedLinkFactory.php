<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RelatedLink>
 */
class RelatedLinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'logo' => fake()->image(null, $width = 200, $height = 200),
            'name' => fake()->words(3, true),
            'link' => fake()->url(),
        ];
    }
}
