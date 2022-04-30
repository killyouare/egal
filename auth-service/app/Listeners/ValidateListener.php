<?php

namespace App\Listeners;

use App\Events\AbstractEvent;
use App\Rules\PhoneNumberRule;
use App\Helpers\MicroserviceValidator;

class ValidateListener extends AbstractListener
{

    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $attributes = $event->getAttrs();

        MicroserviceValidator::validate($attributes, [
            "id" =>  'required',
            "first_name" =>  'required|string',
            "last_name" =>  'required|string',
            "phone" => [new PhoneNumberRule, 'required'],
        ]);
    }
}
