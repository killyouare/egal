<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Illuminate\Support\Str;

class SetUUIDListener extends AbstractListener
{

    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $uid = Str::uuid();

        $event->setModelAttr("id", $uid);
    }
}
