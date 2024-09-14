<?php

namespace Database\Factories;

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
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'position' => $this->faker->jobTitle(),
            'salary' => $this->faker->numberBetween(3000000, 15000000), // Rentang gaji antara 3 juta hingga 15 juta
            'hire_date' => $this->faker->date(), // Format tanggal YYYY-MM-DD
            'department_id' => \App\Models\Department::factory(), // Asumsi terdapat model Department
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Kata sandi standar
            'remember_token' => Str::random(10),
        ];
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
}
