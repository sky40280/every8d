<?php

namespace Recca0120\Every8d;

use Illuminate\Support\ServiceProvider;

class Every8dServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            $config = $app['config']['broadcasting.connections.every8d'];

            return new Client($config['user_id'], $config['password']);
        });
    }
}
