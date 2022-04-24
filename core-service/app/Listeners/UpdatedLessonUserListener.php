<?php

namespace App\Listeners;

use App\Events\UpdatedLessonUserEvent;
use App\Models\CourseUser;
use App\Models\Course;
use App\Models\LessonUser;
use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;

class UpdatedLessonUserListener
{
    public function handle(UpdatedLessonUserEvent $event): void
    {
        $lessonuser = $event->lu->getAttributes();

        $user_id = $lessonuser['user_id'];

        $lessons = Course::actionGetItems(null, [
            "lessons"
        ], [
            [
                "id", "eq", $lessonuser['course_id']
            ]
        ], []);
        $complitedLessonsCount = LessonUser::whereIn('lesson_id', $lessons)->where([
            'user_id' => $user_id,
            'is_passed' => 1
        ])->count();
        CourseUser::where([
            'user_id' => $user_id,
            'course_id' => $course_id
        ])->first()->update(['percentage_passing' => round($complitedLessonsCount / $lessons->count() * 100)]);
    }
}
