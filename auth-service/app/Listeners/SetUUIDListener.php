<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use Illuminate\Support\Str;

class SetUUIDListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $uid = Str::uuid();

        $event->setModelAttribute("id", $uid);
    }
}
