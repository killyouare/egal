<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;

class UpdatingLessonUserEvent extends Event
{
    // Добавить типизацию
    public $model;
    // Отступ
    public function __construct(LessonUser $model)
    {
        $this->model = $model;
    }
}
