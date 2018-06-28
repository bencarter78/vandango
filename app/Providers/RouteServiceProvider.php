<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(function () {
                 require base_path('routes/apply.php');
                 require base_path('routes/auditor.php');
                 require base_path('routes/blink.php');
                 require base_path('routes/classroom.php');
                 require base_path('routes/cpd.php');
                 require base_path('routes/eportfolios.php');
                 require base_path('routes/forum.php');
                 require base_path('routes/judi.php');
                 require base_path('routes/roommate.php');
                 require base_path('routes/surveyhound.php');
                 require base_path('routes/usermanager.php');
                 require base_path('routes/web.php');
             });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(function () {
                 require base_path('routes/api/api.php');
                 require base_path('routes/api/apply.php');
                 require base_path('routes/api/auditor.php');
                 require base_path('routes/api/blink.php');
                 require base_path('routes/api/classroom.php');
                 require base_path('routes/api/cpd.php');
                 require base_path('routes/api/datastore.php');
                 require base_path('routes/api/eportfolios.php');
                 require base_path('routes/api/forum.php');
                 require base_path('routes/api/ignite.php');
                 require base_path('routes/api/judi.php');
                 require base_path('routes/api/locations.php');
                 require base_path('routes/api/papi.php');
                 require base_path('routes/api/roommate.php');
                 require base_path('routes/api/usermanager.php');
             });
    }
}
