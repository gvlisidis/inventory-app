<?php

namespace Database\Factories;

use App\Enums\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $groups = Group::getAllValues();
        return [
            'name' => $this->faker->words(rand(1,3), true),
            'group' => $groups[array_rand($groups, 1)],
        ];
    }
}
