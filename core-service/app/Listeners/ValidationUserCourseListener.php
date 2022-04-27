<?php

namespace App\Listeners;

use App\Events\UpdatingLessonUserEvent;
use App\Rules\CourseDriedRule;
use Egal\Model\Exceptions\ValidateException;
use Illuminate\Support\Facades\Validator;

class ValidationUserCourseListener
{

    public function handle(UpdatingLessonUserEvent $event): void
    {
        $attributes = $event->model->getAttributes();
        // validator в helper
        $validator = Validator::make($attributes, [
            "lesson_id" => [new CourseDriedRule],
        ]);

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());
            throw $exception;
        }
    }
}
