<?php

namespace App\Helpers;

use Egal\Core\Events\Event as EgalEvent;

abstract class Event extends EgalEvent
{

    public function getModel()
    {
        return $this->model;
    }

    public function getAttrs(): array
    {
        return $this->model->getAttributes();
    }

    public function setModelAttr(string $name, mixed $value): void
    {
        $this->model->setAttribute($name, $value);
    }

    public function clearModelAttr(string $attr): void
    {
        $this->model->offsetUnset($attr);
    }
}
