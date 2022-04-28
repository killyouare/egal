<?php

namespace App\Listeners;

use App\Events\SaveModelUserEvent;
use Illuminate\Support\Str;

class SetUUIDListener
{

    public function handle(SaveModelUserEvent $event): void
    {
        $uid = Str::uuid();

        $event->setModelAttr("id", $uid);
    }
}
