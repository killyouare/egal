<?php

namespace App\Listeners;

use App\Models\Speaker;
use Egal\Core\Listeners\EventListener;
use Egal\Core\Session\Session;

class AdditionUserServiceTokenListener extends EventListener
{
    public function handle(): void
    {
        Session::getUserServiceToken()->addRole('admin');
        Session::getUserServiceToken()->addRole('user');
    }
}
