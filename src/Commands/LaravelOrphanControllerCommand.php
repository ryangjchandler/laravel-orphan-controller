<?php

namespace RyanChandler\LaravelOrphanController\Commands;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Routing\RouteCollectionInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionMethod;
use SplFileInfo;

class LaravelOrphanControllerCommand extends Command
{
    public $signature = 'orphan-controller:find {--compact}';

    public $description = 'Search your application for controllers with no routes.';

    protected RouteCollectionInterface $routes;

    public function handle()
    {
        $this->loadRoutes();

        $directories = config('orphan-controller.paths');
        $orphans = collect();

        foreach ($directories as $directory) {
            $files = $this->getControllersInDirectory($directory);

            foreach ($files as $file) {
                $class = $this->classFromFile($file);

                if (! class_exists($class) || $class === 'App\\Http\\Controllers\\Controller') {
                    continue;
                }

                $reflection = new ReflectionClass($class);

                if ($reflection->isAbstract()) {
                    continue;
                }

                $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

                foreach ($methods as $method) {
                    $action = [$class, $method->getName()];

                    if ($this->hasRouteForAction($action)) {
                        continue;
                    }

                    $orphans->push($action);
                }
            }
        }

        if ($orphans->isEmpty()) {
            $this->info('No orphaned controllers found.');

            return 0;
        }

        $this->comment('Found ' . $orphans->count() . ' orphaned ' . Str::plural('controller', $orphans->count()) . '.');

        $this->table([
            'Class', 'Method'
        ], $orphans->mapWithKeys(function (array $action) {
            return [[
                'Class' => $action[0],
                'Method' => $action[1],
            ]];
        }), $this->option('compact') ? 'compact' : 'default');
    }

    protected function loadRoutes()
    {
        $this->routes = Route::getRoutes();
    }

    protected function hasRouteForAction(array $action)
    {
        return $this->routes->getByAction($action[0].'@'.$action[1]) !== null;
    }

    protected function getControllersInDirectory(string $directory)
    {
        $iterator = new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS);

        return new RecursiveIteratorIterator($iterator);
    }

    protected function classFromFile(SplFileInfo $file)
    {
        $class = trim(Str::replaceFirst(base_path(), '', $file->getRealPath()), DIRECTORY_SEPARATOR);

        return str_replace(
            [DIRECTORY_SEPARATOR, ucfirst(basename($this->getLaravel()->path())).'\\'],
            ['\\', $this->getLaravel()->getNamespace()],
            ucfirst(Str::replaceLast('.php', '', $class))
        );
    }
}
