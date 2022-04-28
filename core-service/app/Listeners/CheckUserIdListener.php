<?php

namespace App\Listeners;

use Egal\Core\Session\Session;
use App\Exceptions\NotOwnerException;
use App\Helpers\Event;

class CheckUserIdListener
{
    public function handle(Event $event): void
    {
        if ($event->getAttr("user_id") !== Session::getUserServiceToken()->getUid()) {
            throw new NotOwnerException();
        }
    }
}
