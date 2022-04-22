<?php

namespace App\Listeners;

use Egal\Core\Listeners\EventListener;
use App\Events\SaveModelUserEvent;
use App\Rules\PhoneNumberRule;
use Illuminate\Support\Facades\Validator;
use Egal\Model\Exceptions\ValidateException;

class ValidateListener
{


    public function handle(SaveModelUserEvent $event): void
    {


        $attributes = $event->user->getAttributes();
        $validator = Validator::make($attributes, [
            "id" =>  'required',
            "first_name" =>  'required|string',
            "last_name" =>  'required|string',
            "phone" => [new PhoneNumberRule, 'required'],
        ]);

        if ($validator->fails()) {
            $exception = new ValidateException();
            $exception->setMessageBag($validator->errors());

            throw $exception;
        }
    }
}
