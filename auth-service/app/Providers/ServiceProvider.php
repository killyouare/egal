<?php

namespace App\Providers;

use App\Helpers\ModelManager;
use Egal\Model\ServiceProvider as ModelServiceProvider;

class ServiceProvider extends ModelServiceProvider
{
    public function register(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([]);
        }

        $this->app->singleton(ModelManager::class, function (): ModelManager {
            return new ModelManager();
        });

        ModelManager::loadModel(ModelManager::class);

        $this->commands([]);
    }
}
