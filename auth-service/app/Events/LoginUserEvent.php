<?php

namespace App\Events;

use App\Models\User;
use Egal\Model\Model;

class LoginUserEvent extends AbstractEvent
{
    private array $userData;

    public function __construct(string $email, string $password)
    {
        $this->userData = [
            "email" => $email,
            "password" => $password
        ];
    }

    public function SetUserModel(Model $model): void
    {
        parent::__construct($model);
    }

    public function getUserAttributes(): array
    {
        return $this->userData;
    }
}
