<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use Egal\Core\Session\Session;
use App\Exceptions\NotOwnerException;

class CheckUserIdListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $user_id = $event->getAttribute("user_id");

        if ($user_id !== Session::getUserServiceToken()->getUid()) {
            throw new NotOwnerException();
        }
    }
}
