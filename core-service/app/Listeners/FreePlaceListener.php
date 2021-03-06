<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use App\Models\Course;
use App\Exceptions\StudentCapacityException;

class FreePlaceListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $student_capacity = Course::findItem($event->getAttribute('course_id'))->student_capacity;

        if ($student_capacity < 1) {
            throw new StudentCapacityException();
        }
    }
}
