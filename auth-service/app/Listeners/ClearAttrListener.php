<?php

namespace App\Listeners;

use App\Events\SaveModelUserEvent;

// Лишний отступ
class ClearAttrListener
{

// Лишний отступ
  public function handle(SaveModelUserEvent $event): void
  {
    $event->user->offsetUnset('first_name');
    $event->user->offsetUnset('last_name');
    $event->user->offsetUnset('phone');
  }
}
