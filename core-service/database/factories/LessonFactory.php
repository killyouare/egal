<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{

    protected $model = Lesson::class;

    public function definition(): array
    {
        return [
            'theme' => $this->faker->word(),
            'course_id' => Course::all()->random()->id,
        ];
    }
}
