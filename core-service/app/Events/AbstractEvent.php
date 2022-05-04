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
            vsprintf(
                "Event [%s] was fired with model [%s]. (%s.) %s",
                [
                    get_class($this),
                    get_class($model),
                    $model->wasChanged()
                        ? "Changes: " . $model->wasChanged()
                        : "Dirty: " . $model->isDirty(),
                    $model->getAttributes()
                        ? "Serialized model $model"
                        : "",
                ]
            )
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

    public function getAttributes(): array
    {
        return $this->model->getAttributes();
    }

    public function getAttribute(string $name): mixed
    {
        return $this->model->getAttribute($name);
    }

    public function setModelAttribute(string $name, mixed $value): void
    {
        $this->model->setAttribute($name, $value);
    }

    public function clearModelAttribute(string $attr): void
    {
        $this->model->offsetUnset($attr);
    }
}
