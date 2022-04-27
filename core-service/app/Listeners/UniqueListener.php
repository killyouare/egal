<?php

namespace App\Listeners;

use App\Events\CreatingModelCourseUserEvent;
use Egal\Core\Listeners\GlobalEventListener;
use Egal\Core\Listeners\EventListener;
use Egal\Model\Exceptions\ValidateException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UniqueListener
{

    public function handle(CreatingModelCourseUserEvent $event): void
    {
        $attributes = $event->model->getAttributes();
        $course_id = $attributes['course_id'];
        // Validator в Helper
        $validator = Validator::make($attributes, [
            "user_id" => "unique:course_users,user_id,null,null,course_id,$course_id",
        ]);

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());
            throw $exception;
        }
    }
}
