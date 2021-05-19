<?php

namespace RyanChandler\LaravelOrphanController;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RyanChandler\LaravelOrphanController\Commands\LaravelOrphanControllerCommand;

class LaravelOrphanControllerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-orphan-controller')
            ->hasConfigFile()
            ->hasCommand(LaravelOrphanControllerCommand::class);
    }
}
