<?php

namespace App\Listeners;

use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;
use App\Helpers\MicroserviceValidator;

class ValidateListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);

        $attributes = $event->getAttributes();

        MicroserviceValidator::validate(
            $attributes,
            [
                "id" =>  "required",
                "password" => "required|string",
                "email" => "required|email|unique:users",
                "first_name" => "required|string",
                "last_name" => "required|string",
                "phone" => "required|phone_number",
            ]
        );
    }
}
