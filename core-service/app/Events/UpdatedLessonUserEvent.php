<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;

class UpdatedLessonUserEvent extends Event
{
    public $model;

    public function __construct(LessonUser $lu)
    {
        $this->model = $lu;
    }
}
