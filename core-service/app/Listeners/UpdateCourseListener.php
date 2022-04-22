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
        $course = Course::where("id", $event->cu->getAttribute('course_id'))->first();
        $course->update([
            'student_capacity' => $course->student_capacity - 1,
        ]);
    }
}
