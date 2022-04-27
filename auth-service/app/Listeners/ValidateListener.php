<?php

namespace App\Listeners;

use Egal\Core\Listeners\EventListener;
use App\Events\SaveModelUserEvent;
use App\Rules\PhoneNumberRule;
use Illuminate\Support\Facades\Validator;
use Egal\Model\Exceptions\ValidateException;

class ValidateListener
{
    //Лишний отступ

    public function handle(SaveModelUserEvent $event): void
    {
        // Лишние отступы
        // SendMessageListener.php обращаемся к $attributes = $event->arguments; тут $event->user->getAttributes();
        // Привести к одному виду
        $attributes = $event->user->getAttributes();
        // Validator::make ... validator->fails лучше вынести в Helper для уменьшения копипаста кода
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
