<?php

namespace App\Events;

use Egal\Model\Model;

class LoginUserEvent extends AbstractEvent
{

    public function __construct(Model $model)
    {
        parent::__construct($model);
    }
}
