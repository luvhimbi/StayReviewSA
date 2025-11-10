<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'poster_id' => User::factory(),
            'property_name' => $this->faker->sentence(3),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->randomElement([
                'Gauteng',
                'Western Cape',
                'KwaZulu-Natal',
                'Eastern Cape',
                'Free State',
                'Limpopo',
                'Mpumalanga',
                'Northern Cape',
                'North West',
            ]),
            'country' => 'South Africa',
            'property_type' => $this->faker->randomElement([
                'apartment','house','studio','room'
            ]),
            'main_image' => $this->faker->imageUrl(640, 480, 'real-estate', true),
            'approved' => $this->faker->boolean(70), // 70% chance approved
            'verified' => $this->faker->boolean(50), // 50% chance verified
        ];
    }
    /**
     * Indicate that the property is pending approval.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'approved' => false,
            'verified' => false,
        ]);
    }

    /**
     * Indicate that the property is approved and verified.
     */
    public function approvedVerified(): static
    {
        return $this->state(fn (array $attributes) => [
            'approved' => true,
            'verified' => true,
        ]);
    }
}
