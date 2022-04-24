<?php

namespace App\Events;

use App\Models\LessonUser;
use Egal\Core\Events\Event;

class UpdatedLessonUserEvent extends Event
{
    public $lu;
    public function __construct(LessonUser $lu)
    {
        $this->lu = $lu;
    }
}
