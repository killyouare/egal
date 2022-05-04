<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use App\Exceptions\IdFieldException;
use App\Exceptions\LessonIdFieldException;
use App\Exceptions\UserIdFieldException;
use App\Helpers\MicroserviceValidator;
use App\Rules\CourseDriedRule;
use Egal\Core\Session\Session;

class ValidationUserCourseListener extends AbstractListener
{

    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $requestAttrs = Session::getActionMessage()->getParameters()['attributes'];
        $attributes = $event->getAttrs();

        if (isset($requestAttrs['id'])) {
            throw new IdFieldException();
        }

        if (isset($requestAttrs['user_id'])) {
            throw new UserIdFieldException();
        }

        if (isset($requestAttrs['lesson_id'])) {
            throw new LessonIdFieldException();
        }

        MicroserviceValidator::validate($attributes, [
            "lesson_id" => [new CourseDriedRule],
        ]);
    }
}
