<?php

namespace App\Helpres;

use App\Helpers\AbstractEvent;

abstract class AbstractListener
{
    abstract public  function handle(AbstractEvent $event): void;
}
