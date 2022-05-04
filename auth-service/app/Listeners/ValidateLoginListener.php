<?php

namespace App\Listeners;

use App\Events\LoginUserEvent;
use App\Models\User;
use Egal\AuthServiceDependencies\Exceptions\LoginException;

class ValidateLoginListener
{
    public function handle(LoginUserEvent $event): void
    {
        $attributes = $event->getUserAttributes();

        $user = User::getUserByEmail($attributes['email']);

        if (!$user || !password_verify($attributes['password'], $user->getAttribute('password'))) {
            throw new LoginException("Incorrect Email or password!");
        }

        $event->setUserModel($user);
    }
}
