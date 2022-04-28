<?php

namespace App\Events;

use App\Helpers\Event;
use App\Models\LessonUser;


class UpdatedLessonUserEvent extends Event
{

    public function __construct(LessonUser $model)
    {
        $this->model = $model;
    }
}
