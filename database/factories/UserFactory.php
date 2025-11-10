<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'), // Default test password
            'role' => $this->faker->randomElement(['admin', 'user']),
            'popi_consent' => $this->faker->boolean(),
            'is_two_factor_enabled' => $this->faker->boolean(20), // 20% chance to be true
            'otp_code' => null,
            'otp_expires_at' => null,
        ];
    }

    /**
     * Indicate that the user should have OTP set.
     */
    public function withOtp(): static
    {
        return $this->state(fn (array $attributes) => [
            'otp_code' => rand(100000, 999999),
            'otp_expires_at' => Carbon::now()->addMinutes(10),
        ]);
    }
    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    /**
     * Define the admin user state.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    /**
     * Define the normal user state.
     */
    public function user(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'user',
        ]);
    }
}
