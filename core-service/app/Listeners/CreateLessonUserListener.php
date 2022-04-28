<?php

namespace App\Listeners;

use App\Events\CreatedModelCourseUserEvent;
use App\Models\Lesson;
use App\Models\LessonUser;

class CreateLessonUserListener
{

    public function handle(CreatedModelCourseUserEvent $event): void
    {
        $attributes = $event->getAttrs();

        $lessons = Lesson::getItemsByCourseId($attributes['course_id'])->get()->toArray();

        foreach ($lessons as $lesson) {
            LessonUser::createItem([
                'user_id' => $attributes['user_id'],
                'lesson_id' => $lesson['id'],
            ]);
        }
    }
}
