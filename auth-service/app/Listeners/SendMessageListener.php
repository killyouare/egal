<?php

namespace App\Listeners;

use App\Events\SaveModelUserEvent;
use Egal\Core\Communication\Request;
use Exception;

class SendMessageListener
{

    public function handle(SaveModelUserEvent $event): void
    {
        $attributes = $event->getAttrs();

        $request = new Request(
            'core',
            'User',
            'create',
            [
                "attributes" => [
                    "id" =>  $attributes['id'],
                    "first_name" =>  $attributes['first_name'],
                    "last_name" =>  $attributes['last_name'],
                    "phone" =>  $attributes['phone'],
                ]
            ],
        );

        $request->call();

        $response = $request->getResponse();

        if ($response->getStatusCode() !== 200) {
            $actionErrorMessage = (string)$response->getActionErrorMessage();
            $actionErrorCode = $response->getStatusCode();
            throw new Exception($actionErrorMessage, $actionErrorCode);
        }
    }
}
