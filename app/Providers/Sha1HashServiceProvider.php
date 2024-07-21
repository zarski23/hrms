<?php

namespace App\Providers;

use App\Hashing\Sha1Hasher;
use Illuminate\Support\ServiceProvider;

class Sha1HashServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('sha1hash', function () {
            return new Sha1Hasher();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
