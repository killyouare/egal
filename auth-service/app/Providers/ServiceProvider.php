<?php

namespace App\Providers;

use Egal\Model\ModelManager;
use Illuminate\Support\ServiceProvider as SupportServiceProvider;

class ServiceProvider extends SupportServiceProvider
{

    protected array $config;

    protected string $class;

    public function __construct($app)
    {
        parent::__construct($app);

        $this->getConfig();
        $this->scanModels();
    }

    private function getConfig()
    {
        $this->config = config("debug");
    }

    protected function scanModels(?string $dir = null): void
    {
        $baseDir = $this->config['debugDir'];

        if ($dir === null) {
            $dir = $baseDir;
        }

        $modelsNamespace = 'App\DebugModels\\';

        foreach (scandir($dir) as $dirItem) {
            $itemPath = str_replace('//', '/', $dir . '/' . $dirItem);

            if ($dirItem === '.' || $dirItem === '..') {
                continue;
            }

            if (is_dir($itemPath)) {
                $this->scanModels($itemPath);
            }

            if (!str_contains($dirItem, '.php')) {
                continue;
            }

            $classShortName = str_replace('.php', '', $dirItem);

            if (!preg_match("/^[a-z]+(Debug)$/i", $classShortName)) {
                continue;
            }

            $class = str_replace($baseDir, '', $itemPath);
            $class = str_replace($dirItem, $classShortName, $class);
            $class = str_replace('/', '\\', $class);
            $this->class = $modelsNamespace . $class;
        }
    }

    public function register(): void
    {
        if ($this->config['include']) {
            ModelManager::loadModel($this->class);
        }

        $this->commands([]);
    }
}
