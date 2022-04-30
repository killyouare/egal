<?php

namespace App\Events;

use App\Models\User;

class SaveModelUserEvent extends AbstractEvent
{

    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
