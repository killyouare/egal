<?php

namespace App\Listeners;

use Egal\Core\Listeners\EventListener;
use App\Events\SaveModelUserEvent;
use Illuminate\Support\Facades\Log;

class SendMessageListener
{

    // Лишний отступ
    public function handle($event): void
    {
        $attributes = $event->arguments;

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
        $request->call();

        $response = $request->getResponse();
        // Можно заменить на тернарный оператор
        if ($response->getStatusCode() != 200) {
            $actionErrorMessage = $response->getActionErrorMessage(); // Получение сообщения ошибки
            // Лишний отступ
        } else {
            $actionResultMessage = $response->getActionResultMessage(); // Получение сообщения результата выполнения [действия](/_glossary?id=действия) }
        }
    }
}
