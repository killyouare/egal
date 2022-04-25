<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;

class UpdatingLessonUserEvent extends Event
{
    public $model;

    public function __construct(LessonUser $model)
    {
        $this->model = $model;
    }
}
