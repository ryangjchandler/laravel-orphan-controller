<?php

namespace RyanChandler\LaravelOrphanController;

use RyanChandler\LaravelOrphanController\Commands\LaravelOrphanControllerCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
