<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Departmentassignment>
 */
class DepartmentassignmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->date();
        $endDate = $this->faker->dateTimeBetween($startDate, '+1 year');
        return [
            'user_id' => \App\Models\User::factory(),
            'department_id' =>  \App\Models\Department::factory(),
            'startdate' =>  $startDate ,
            'enddate' =>  $endDate
        ];
    }
}
