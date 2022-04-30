<?php

namespace App\Helpers;

use Egal\Core\Events\Event as EgalEvent;
use Egal\Model\Model;

abstract class AbstractEvent extends EgalEvent
{

    protected Model $model;

    public function __construct(Model $model)
    {
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
}
