<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Illuminate\Support\Facades\Log;

abstract class AbstractListener
{
    public  function handle(AbstractEvent $event): void
    {
        Log::info("Listener ["
            . __CLASS__
            . "] event ["
            . get_class($event)
            . "].");
    }
}
