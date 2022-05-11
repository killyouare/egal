<?php

namespace App\Listeners;

use Egal\Core\Communication\Request;
use Exception;
use Killyouare\Helpers\AbstractEvent;
use Killyouare\Helpers\AbstractListener;

class SendMessageListener extends AbstractListener
{
    public function handle(AbstractEvent $event): void
    {
        parent::handle($event);
        $attributes = $event->getAttributes();

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
