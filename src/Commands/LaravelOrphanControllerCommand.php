<?php

namespace RyanChandler\LaravelOrphanController\Commands;

use Illuminate\Console\Command;

class LaravelOrphanControllerCommand extends Command
{
    public $signature = 'orphan-controller:find';

    public $description = 'Search your application for controllers with no routes.';

    public function handle()
    {
        $this->comment('All done');
    }
}
