<?php

namespace App\Events;

use Egal\Core\Events\Event;

class CreatedModelCourseUserEvent extends Event
{

    public $cu;
    public function __construct($data)
    {
        $this->cu = $data;
    }
}
