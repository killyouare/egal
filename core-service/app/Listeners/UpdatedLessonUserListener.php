<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;
use App\Models\CourseUser;
// Лишняя зависимость
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUser;
use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;

class UpdatedLessonUserListener
{
    // Отступ
    public function handle(UpdatedLessonUserEvent $event): void
    {
        // CamelCase
        $lessonuser = $event->model->getAttributes();
        // Получение через builder
        $lesson = Lesson::actionGetItem($lessonuser['lesson_id']);
        // Зачем 2 запроса на items и count ?
        $lessons = Lesson::actionGetItems(null, [], [
            [
                "course_id", "eq", $lesson['course_id']
            ],

        ], []);
        $lessonsCount = Lesson::actionGetCount([
            [
                "course_id", "eq", $lesson['course_id']
            ],

        ])['count'];
        // Лучше получить collection всех уроков пользователя которые он прошел и посчитать на стороне рhp
        // Или сделать view агрегирующее количество записей
        // Но посылать столько запросов через foreach точно не стоит
        $count = 0;
        foreach ($lessons['items'] as $lesson) {
            $count += LessonUser::actionGetCount([
                ["user_id", "eq", $lessonuser['user_id']],
                "AND",
                ["lesson_id", "eq", $lesson['id']],
                "AND",
                ["is_passed", "eq", true]
            ])['count'];
        }
        $cuId = CourseUser::actionGetItems(null, [], [
            ['user_id', 'eq', $lessonuser['user_id']],
            "AND",
            ['course_id', "eq", $lesson['course_id']]
        ], [])['items'][0]['id'];

        CourseUser::actionUpdate($cuId, [
            'percentage_passing' => round($count / $lessonsCount * 100)
        ]);
    }
}
