<?php

namespace Incubout\Heartbeats;

use Illuminate\Support\ServiceProvider;

class HeartbeatsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register commands
        $this->commands([
            'Incubout\Heartbeats\Console\Commands\SendHeartbeat'
        ]);
    }
}
