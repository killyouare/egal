<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;

class UpdatedLessonUserEvent extends Event
{
    // Добавить типизацию
    public $model;
    // Отступ
    public function __construct(LessonUser $lu)
    {
        $this->model = $lu;
    }
}
