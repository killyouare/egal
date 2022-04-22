<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Core\Events\EventServiceProvider as ServiceProvider;
use App\Events\SaveModelUserEvent;
use App\Listeners\SendMessageListener;
use App\Listeners\ValidateListener;
use App\Listeners\ClearAttrListener;

class EventServiceProvider extends ServiceProvider
{


    /**
     * Определение обработчиков локальных событий
     */
    protected $listen = [
        SaveModelUserEvent::class => [
            ValidateListener::class,
            SendMessageListener::class,
            ClearAttrListener::class,
        ]
    ];
}
