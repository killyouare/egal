<?php

namespace App\Listeners;

use App\Events\SaveModelUserEvent;

class ClearAttrListener
{

  public function handle(SaveModelUserEvent $event): void
  {
    $event->ClearModelAttr('first_name');
    $event->ClearModelAttr('last_name');
    $event->ClearModelAttr('phone');
  }
}
