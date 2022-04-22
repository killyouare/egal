<?php

namespace App\Listeners;

use Egal\Core\Listeners\EventListener;
use App\Events\SaveModelUserEvent;
use App\Rules\PhoneNumberRule;
use Illuminate\Support\Facades\Validator;
use Egal\Model\Exceptions\ValidateException;

class SendMessageListener
{


    public function handle(SaveModelUserEvent $event): void
    {
        $attributes = $event->user->getAttributes();

        $request = new \Egal\Core\Communication\Request(
            'core', // Сервис назначения запроса
            'User', // К какой модели обращение
            'create', // К какому действию обращение
            [
                "attributes" => [
                    "id" =>  $attributes['id'],
                    "first_name" =>  $attributes['first_name'],
                    "last_name" =>  $attributes['last_name'],
                    "phone" =>  $attributes['phone'],
                ]
            ],
        );

        $request->send();
    }
}
