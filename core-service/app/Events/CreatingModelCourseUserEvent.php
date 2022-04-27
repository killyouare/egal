<?php

namespace App\Events;

use Egal\Core\Events\Event;
use App\Models\CourseUser;

class CreatingModelCourseUserEvent extends Event
{
    // Добавить типизацию
    public $model;
    // Отступ
    public function __construct(CourseUser $data)
    {
        $this->model = $data;
    }
}
