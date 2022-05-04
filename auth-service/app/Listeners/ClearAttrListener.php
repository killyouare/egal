<?php

namespace App\Listeners;

use App\Events\AbstractEvent;

class ClearAttrListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $event->clearModelAttribute('first_name');
        $event->clearModelAttribute('last_name');
        $event->clearModelAttribute('phone');
    }
}
