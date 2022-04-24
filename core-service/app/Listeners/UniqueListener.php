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
        $attributes = $event->cu->getAttributes();
        $validator = Validator::make($attributes, [
            "id" => [Rule::unique("course_users")->where(function ($query) use ($attributes) {
                return $query->where([
                    'user_id' => $attributes['user_id'],
                    'course_id' => $attributes['course_id']
                ]);
            })]
        ]);

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());
            throw $exception;
        }
    }
}
