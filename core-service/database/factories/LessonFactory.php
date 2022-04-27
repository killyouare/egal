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
        // Лучше id подставлять в seeder, потому что для каждой генерируемой записи урока будет отправляться запрос на
        // получение списка всех курсов
        // Запросить все курсы, затем на стороне php выбирать случайным образом id
        return [
            'theme' => $this->faker->word(),
            'course_id' => Course::all()->random()->id,
        ];
    }
}
