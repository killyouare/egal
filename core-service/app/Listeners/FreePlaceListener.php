<?php

namespace App\Listeners;

use App\Models\Course;
use App\Events\CreatingModelCourseUserEvent;
use App\Exceptions\StudentCapacityException;

class FreePlaceListener
{

    public function handle(CreatingModelCourseUserEvent $event): void
    {
        $student_capacity = Course::findItem($event->getAttr('course_id'))->student_capacity;
        if ($student_capacity < 1) {
            throw new StudentCapacityException();
        }
    }
}
