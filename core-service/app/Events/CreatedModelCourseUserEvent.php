<?php

namespace App\Events;

use App\Helpers\Event;
use App\Models\CourseUser;

class CreatedModelCourseUserEvent extends Event
{

    public function __construct(CourseUser $model)
    {
        $this->model = $model;
    }
}
