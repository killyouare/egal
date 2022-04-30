<?php

namespace App\Events;

use Egal\Core\Events\Event as EgalEvent;
use Egal\Model\Model;
use Illuminate\Support\Facades\Log;

abstract class AbstractEvent extends EgalEvent
{

    protected Model $model;

    public function __construct(Model $model)
    {
        Log::info(
            'Event [' . __CLASS__
                . '] was fired with model: ['
                . get_class($model)
                . ']. (Changes: ' . $model->wasChanged()
                . ', Dirty: ' . $model->isDirty()
                . ") Serialized model: ",
            [$model->toArray()]
        );
        $this->setModel($model);
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
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
