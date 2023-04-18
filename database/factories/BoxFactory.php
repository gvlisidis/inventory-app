<?php

namespace Database\Factories;

use App\Enums\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Box>
 */
class BoxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = Location::getAllValues();
        return [
            'name' => $this->faker->words(rand(1,3), true),
            'uri' => $this->faker->url(),
            'location' => $locations[array_rand($locations, 1)],
            'description' => $this->faker->sentences(rand(1,4), true),
        ];
    }
}
