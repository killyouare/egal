<?php

namespace App\Events;

use App\Models\CourseUser;
use Egal\Core\Events\Event;

class CreatedModelCourseUserEvent extends Event
{

    // Добавить типизацию
    public $model;
    // Отступ
    public function __construct(CourseUser $data)
    {
        $this->model = $data;
    }
}
