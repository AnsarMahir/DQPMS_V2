<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class FirebaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('firebase', function ($app) {
            $factory = (new Factory)
                ->withServiceAccount(config('firebase.projects.app.credentials'))
                ->withDefaultStorageBucket(config('firebase.projects.app.storage.default_bucket'));
            
            return $factory->createStorage();
        });
    }

    public function boot()
    {
        //
    }
}
