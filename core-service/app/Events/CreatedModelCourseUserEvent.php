<?php

namespace App\Events;

use App\Models\CourseUser;
use Egal\Core\Events\Event;

class CreatedModelCourseUserEvent extends Event
{

    public $cu;
    public function __construct(CourseUser $data)
    {
        $this->cu = $data;
    }
}
