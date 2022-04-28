<?php

namespace App\Events;

use App\Helpers\Event;
use App\Models\LessonUser;


class UpdatingLessonUserEvent extends Event
{

    public function __construct(LessonUser $model)
    {
        $this->model = $model;
    }
}
