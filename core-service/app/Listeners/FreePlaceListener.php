<?php

namespace App\Listeners;

use App\Models\Course;
use App\Events\CreatingModelCourseUserEvent;
use App\Exceptions\StudentCapacityException;

class FreePlaceListener
{

    public function handle(CreatingModelCourseUserEvent $event): void
    {
        $course = Course::actionGetItem($event->cu->getAttribute('course_id'));
        if ($course['student_capacity'] < 1) {
            throw new StudentCapacityException();
        }
    }
}
