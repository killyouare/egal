<?php

namespace App\Listeners;

use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;
use App\Events\CreatedModelCourseUserEvent;
use App\Models\Course;

class UpdateCourseListener
{

    public function handle(CreatedModelCourseUserEvent $event): void
    {
        $courseId = $event->cu->getAttribute('course_id');
        $course = Course::actionGetItem($courseId);

        Course::actionUpdate($courseId, [
            "student_capacity" => $course['student_capacity'] - 1
        ]);
    }
}
