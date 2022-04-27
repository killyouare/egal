<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace App\Providers;

use Egal\Core\Events\EventServiceProvider as ServiceProvider;
use App\Events\CreatingModelCourseUserEvent;
use App\Events\CreatedModelCourseUserEvent;
use App\Events\UpdatedLessonUserEvent;
use App\Events\UpdatingLessonUserEvent;
use App\Listeners\CheckUserIdListener;
use App\Listeners\FreePlaceListener;
use App\Listeners\UpdateCourseListener;
use App\Listeners\CreateLessonUserListener;
use App\Listeners\UniqueListener;
use App\Listeners\UpdatedLessonUserListener;
use App\Listeners\ValidationUserCourseListener;

class EventServiceProvider extends ServiceProvider
{

    // Лишний отступ
    protected $listen = [
        CreatingModelCourseUserEvent::class => [
            UniqueListener::class,
            CheckUserIdListener::class,
            FreePlaceListener::class,
        ],
        CreatedModelCourseUserEvent::class => [
            UpdateCourseListener::class,
            CreateLessonUserListener::class,
        ],
        UpdatingLessonUserEvent::class => [
            CheckUserIdListener::class,
            ValidationUserCourseListener::class,
        ],
        UpdatedLessonUserEvent::class => [
            UpdatedLessonUserListener::class
        ],
    ];
}
