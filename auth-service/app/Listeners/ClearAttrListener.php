<?php

namespace App\Listeners;

use Egal\Core\Listeners\EventListener;
use App\Events\SaveModelUserEvent;
use App\Rules\PhoneNumberRule;
use Illuminate\Support\Facades\Validator;
use Egal\Model\Exceptions\ValidateException;

class ClearAttrListener
{


  public function handle(SaveModelUserEvent $event): void
  {
    $event->user->offsetUnset('first_name');
    $event->user->offsetUnset('last_name');
    $event->user->offsetUnset('phone');
  }
}
