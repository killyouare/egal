<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Illuminate\Support\Facades\Log;

abstract class AbstractListener
{
    public  function handle(AbstractEvent $event): void
    {
        Log::info("Listener ["
            . get_class($this)
            . "] event ["
            . get_class($event)
            . "].");
    }
}
