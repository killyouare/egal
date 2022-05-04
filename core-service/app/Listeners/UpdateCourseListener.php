<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use App\Models\Course;

class UpdateCourseListener extends AbstractListener
{

    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $courseId = $event->getAttr('course_id');
        $course = Course::findItem($courseId);

        $course->update([
            "student_capacity" => $course->student_capacity - 1
        ]);
    }
}
