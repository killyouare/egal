<?php

namespace App\Events;

use App\Helpers\Event;
use App\Models\User;

class SaveModelUserEvent extends Event
{

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
