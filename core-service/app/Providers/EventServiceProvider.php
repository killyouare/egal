<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Core\Events\EventServiceProvider as ServiceProvider;
use App\Events\CreatingModelCourseUserEvent;
use App\Events\CreatedModelCourseUserEvent;
use App\Listeners\CheckUserIdListener;
use App\Listeners\FreePlaceListener;
use App\Listeners\UpdateCourseListener;
use App\Listeners\CreateLessonUserListener;

class EventServiceProvider extends ServiceProvider
{


    protected $listen = [
        CreatingModelCourseUserEvent::class => [
            CheckUserIdListener::class,
            FreePlaceListener::class,
        ],
        CreatedModelCourseUserEvent::class => [
            UpdateCourseListener::class,
            CreateLessonUserListener::class,
        ],
    ];
}
