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
            'start_date' => $this->faker->dateTimeInInterval("+1 days",  "+5 days"), //Сделать из этого string
            'end_date' => $this->faker->dateTimeInInterval("+6 days",  "+11 days"), //
            'has_certificate' => $this->faker->boolean(),
        ];
    }
}
