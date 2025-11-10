<?php

namespace Database\Factories;

use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'property_id' => Property::factory(),
            'title' => $this->faker->sentence(5),
            'review' => $this->faker->paragraph(3),
            'cleanliness' => $this->faker->numberBetween(1, 5),
            'location' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->numberBetween(1, 5),
        ];
    }
}
