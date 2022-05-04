<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use Illuminate\Support\Facades\Log;

abstract class AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        Log::info(
            vsprintf(
                "Listener [%s] event [%s].",
                [
                    get_class($this),
                    get_class($event),
                ]
            )
        );
    }
}
