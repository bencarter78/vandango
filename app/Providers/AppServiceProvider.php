<?php

namespace App\Providers;

use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Illuminate\Contracts\Auth\Registrar', 'App\Services\Registrar');
        $this->app->bind('App\Contracts\DbRepository', 'App\Core\EloquentRepository');
        $this->app->bind('App\Contracts\HttpClient', 'App\Services\HttpClient');
        $this->app->bind('App\Contracts\Datastore', 'App\Core\Pics');
        $this->app->bind('App\Contracts\Services\Messenger', 'App\Services\Messenger\Messenger');
        $this->app->bind('App\Contracts\Mail\Client', 'App\Services\Mail\Client');
        $this->app->bind('App\Contracts\Mail\Events', 'App\Services\Mail\Events');
        $this->app->bind('App\Contracts\Mail\Mailer', 'App\Services\Mail\Mailman');
        $this->app->bind('App\Contracts\Requests', 'App\Services\Http\Requests');

        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
