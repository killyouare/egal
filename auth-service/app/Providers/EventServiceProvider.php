<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use App\Events\LoginUserEvent;
use Egal\Core\Events\EventServiceProvider as ServiceProvider;
use App\Events\SaveModelUserEvent;
use App\Listeners\SendMessageListener;
use App\Listeners\ValidateListener;
use App\Listeners\ClearAttrListener;
use App\Listeners\SetUUIDListener;
use App\Listeners\UpdateLoginTimeListener;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        SaveModelUserEvent::class => [
            SetUUIDListener::class,
            ValidateListener::class,
            SendMessageListener::class,
            ClearAttrListener::class,
        ],
        LoginUserEvent::class => [
            UpdateLoginTimeListener::class,
        ]
    ];
}
