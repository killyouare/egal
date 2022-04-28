<?php

namespace App\Events;

use App\Helpers\Event;
use App\Models\CourseUser;

class CreatingModelCourseUserEvent extends Event
{

    public function __construct(CourseUser $data)
    {
        $this->model = $data;
    }
}
