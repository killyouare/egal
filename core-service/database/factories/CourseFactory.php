<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'student_capacity' => $this->faker->randomDigit() + 1,
            'start_date' => $this->faker->dateTimeInInterval('+1 days', '+3 days')->format('Y-m-d'),
            'end_date' => $this->faker->dateTimeInInterval("+5 days", '+2 days')->format("Y-m-d"),
            'has_certificate' => $this->faker->boolean()
        ];
    }
}
