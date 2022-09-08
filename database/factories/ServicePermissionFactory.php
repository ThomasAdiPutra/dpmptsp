<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServicePermission>
 */
class ServicePermissionFactory extends Factory
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
            'name' => fake()->words(random_int(1,3), true),
            'requirement' => fake()->words(random_int(50,100), true),
        ];
    }
}
