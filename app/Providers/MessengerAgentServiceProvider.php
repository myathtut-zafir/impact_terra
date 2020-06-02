<?php

namespace App\Providers;

use App\Utils\MessengerAgent;
use Illuminate\Support\ServiceProvider;

class MessengerAgentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MessengerAgent', function () {
            return new MessengerAgent();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
