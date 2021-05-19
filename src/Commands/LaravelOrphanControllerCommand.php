<?php

namespace RyanChandler\LaravelOrphanController\Commands;

use FilesystemIterator;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class LaravelOrphanControllerCommand extends Command
{
    public $signature = 'orphan-controller:find';

    public $description = 'Search your application for controllers with no routes.';

    protected $routes;

    public function handle()
    {
        $this->loadRoutes();

        $directories = config('orphan-controller.paths');

        foreach ($directories as $directory) {
            $files = $this->getControllersInDirectory($directory);

            dd($files);
        }
    }

    protected function loadRoutes()
    {
        $this->routes = Route::getRoutes();
    }

    protected function hasRouteForAction(array $action)
    {
    }

    protected function getControllersInDirectory(string $directory)
    {
        $iterator = new RecursiveDirectoryIterator($directory, FilesystemIterator::SKIP_DOTS);

        return new RecursiveIteratorIterator($iterator);
    }
}
