<?php

namespace App\Listeners;

use Egal\Core\Listeners\EventListener;
use App\Events\SaveModelUserEvent;
use App\Rules\PhoneNumberRule;
use App\Helpers\MicroserviceValidator;

class ValidateListener
{

    public function handle(SaveModelUserEvent $event): void
    {

        $attributes = $event->getAttrs();

        MicroserviceValidator::validate($attributes, [
            "id" =>  'required',
            "first_name" =>  'required|string',
            "last_name" =>  'required|string',
            "phone" => [new PhoneNumberRule, 'required'],
        ]);
    }
}
