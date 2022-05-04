<?php

namespace App\Listeners;

use App\Events\AbstractEvent;

class ClearAttrListener extends AbstractListener
{

  public function handle(AbstractEvent $event): void
  {
    parent::handle($event);

    $event->ClearModelAttr('first_name');
    $event->ClearModelAttr('last_name');
    $event->ClearModelAttr('phone');
  }
}
