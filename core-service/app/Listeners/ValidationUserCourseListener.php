<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use App\Helpers\CheckArrayForMatches;
use App\Helpers\MicroserviceValidator;
use Egal\Core\Session\Session;

class ValidationUserCourseListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $requestAttrs = Session::getActionMessage()->getParameters()['attributes'];

        CheckArrayForMatches::checkArray(
            $requestAttrs,
            ["id", "user_id", "lesson_id"]
        );

        $attributes = $event->getAttributes();

        MicroserviceValidator::validate($attributes, [
            "lesson_id" => "course_dried",
        ]);
    }
}
