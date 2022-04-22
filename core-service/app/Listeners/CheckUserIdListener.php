<?php

namespace App\Listeners;

use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;
use App\Events\CreatingModelCourseUserEvent;
use Egal\Core\Session\Session;
use App\Exceptions\NotOwnerException;

class CheckUserIdListener
{

    public function handle(CreatingModelCourseUserEvent $event): void
    {
        if ($event->cu->getAttribute("user_id") != Session::getUserServiceToken()->getUid()) {
            throw new NotOwnerException();
        }
    }
}
