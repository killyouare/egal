<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;
use App\Models\CourseUser;
use App\Models\Lesson;
use App\Models\LessonUser;

class UpdatedLessonUserListener
{

    public function handle(UpdatedLessonUserEvent $event): void
    {
        $attributes = $event->getAttrs();

        $course = Lesson::findItem($attributes['lesson_id'])->course;
        $lessons =  $course->lessons;

        $courseUser = CourseUser::findByFields([
            'course_id' => $course->id,
            'user_id' => $attributes['user_id'],
        ]);

        $countPassed = LessonUser::query()->whereIn('lesson_id', $lessons->pluck('id'))
            ->where([
                'user_id' => $attributes['user_id'],
                'is_passed' => true
            ])->count();

        $courseUser->update(['percentage_passing' => round(($countPassed / $lessons->count() * 100))]);
    }
}
