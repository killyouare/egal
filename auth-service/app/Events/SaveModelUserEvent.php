<?php

namespace App\Events;

use Egal\Core\Events\Event;
use App\Models\User;
use Illuminate\Queue\SerializesModels;

class SaveModelUserEvent extends Event
{
    use SerializesModels;

    // Добавить типизацию
    public $user;
    public $arguments;
    // Отступ
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->arguments = $user->getAttributes();
    }
}
