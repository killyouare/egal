<?php

namespace App\Helpers;

use Egal\Core\Events\Event as EgalEvent;
use Egal\Model\Model;

abstract class Event extends EgalEvent
{

    protected Model $model;

    public function getModel()
    {
        return $this->model;
    }

    public function getAttrs(): array
    {
        return $this->model->getAttributes();
    }

    public function getAttr(string $value): mixed
    {
        return $this->model->getAttribute($value);
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
