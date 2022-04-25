<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;
use App\Models\CourseUser;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUser;
use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;

class UpdatedLessonUserListener
{
    public function handle(UpdatedLessonUserEvent $event): void
    {
        $lessonuser = $event->model->getAttributes();
        $lesson = Lesson::actionGetItem($lessonuser['lesson_id']);
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
