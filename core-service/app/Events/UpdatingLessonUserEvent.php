<?php

namespace App\Events;

use Egal\Model\Model;

class UpdatingLessonUserEvent extends AbstractEvent
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
