<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Carbon\Carbon;

class UpdateLoginTimeListener extends AbstractListener
{

    public function handle($event): void
    {
        parent::handle($event);

        $user = $event->getModel();

        $userLoginTime = $event->getAttr('login_time');

        $userLoginTime ?
            $userLoginTime[] = Carbon::now() :
            $userLoginTime = [Carbon::now()];

        $user->update(['login_time' => $userLoginTime]);
    }
}
