<?php

namespace App\Listeners;

use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;
use App\Events\CreatedModelCourseUserEvent;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\LessonUser;

class CreateLessonUserListener
{

    public function handle(CreatedModelCourseUserEvent $event): void
    {
        $attributes = $event->cu->getAttributes();
        $lessons = Lesson::actionGetItems(null, [], [
            ["course_id", "eq", $attributes['course_id']]
        ], []);
        dd($lessons);
        foreach ($lessons as $lesson) {
            LessonUser::actionCreate([
                'user_id' => $attributes['user_id'],
                'lesson_id' => $lesson->id,
            ]);
        }
    }
}
