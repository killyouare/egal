<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Carbon\Carbon;

class UpdateLoginTimeListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $user = $event->getModel();

        $userLoginTime = $event->getAttribute('login_time');

        $userLoginTime[] = Carbon::now();

        $user->update(['login_time' => $userLoginTime]);
    }
}
