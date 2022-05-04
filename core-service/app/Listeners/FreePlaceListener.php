<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use App\Models\Course;
use App\Exceptions\StudentCapacityException;

class FreePlaceListener extends AbstractListener
{

    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $student_capacity = Course::findItem($event->getAttr('course_id'))->student_capacity;

        if ($student_capacity < 1) {
            throw new StudentCapacityException();
        }
    }
}
