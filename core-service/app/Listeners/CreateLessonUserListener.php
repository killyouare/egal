<?php

namespace App\Listeners;

use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;
use App\Events\CreatedModelCourseUserEvent;
use App\Models\Lesson;
use App\Models\LessonUser;

class CreateLessonUserListener
{

    public function handle(CreatedModelCourseUserEvent $event): void
    {
        $attributes = $event->cu->getAttributes();

        $lessons = Lesson::where('course_id', $attributes['course_id'])->get();

        foreach ($lessons as $lesson) {
            LessonUser::create([
                'user_id' => $attributes['user_id'],
                'lesson_id' => $lesson->id,
                'is_passed' => 0
            ]);
        }
    }
}
