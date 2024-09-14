<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
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
            'date' => $this->faker->date(),
            'check_in' => Carbon::parse($this->faker->time('H:i:s')),
            'check_out' => Carbon::parse($this->faker->time('H:i:s')),
            'status' => $this->faker->randomElement(['present', 'absent', 'late']),
        ];
    }
}
