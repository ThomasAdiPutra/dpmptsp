<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserSocialMedia>
 */
class UserSocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'social_media' => array('facebook', 'twiter', 'instagram')[array_rand(['facebook', 'twiter', 'instagram'])],
            'url' => fake()->url(),
        ];
    }
}