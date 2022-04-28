<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Core\Events\EventServiceProvider as ServiceProvider;
use App\Events\SaveModelUserEvent;
use App\Listeners\SendMessageListener;
use App\Listeners\ValidateListener;
use App\Listeners\ClearAttrListener;
use App\Listeners\SetUUIDListener;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        SaveModelUserEvent::class => [
            SetUUIDListener::class,
            ValidateListener::class,
            SendMessageListener::class,
            ClearAttrListener::class,
        ],
    ];
}
