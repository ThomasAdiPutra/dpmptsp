<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServicePermissionForm>
 */
class ServicePermissionFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id' => Service::inRandomOrder()->first()->id,
            'name' => fake()->words(3, true),
            'form' => fake()->url(),
        ];
    }
}
