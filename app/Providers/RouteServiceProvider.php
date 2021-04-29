<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

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
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/dashboard';

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
        $this->mapDashboardPostRoutes();
        $this->mapDashboardUserRoutes();
        $this->mapDashboardRolesRoutes();
        $this->mapDashboardPermissionsRoutes();
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
            ->group(base_path('routes/web/web.php'));
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
            ->group(base_path('routes/api/api.php'));
    }

    protected function mapDashboardPostRoutes()
    {
        Route::prefix('dashboard')
        ->namespace($this->namespace)
        ->middleware('web')
        ->group(base_path('routes/web/posts.php'));
    }

    protected function mapDashboardUserRoutes()
    {
        Route::prefix('dashboard')
        ->namespace($this->namespace)
        ->middleware('web')
        ->group(base_path('routes/web/users.php'));
    }


    protected function mapDashboardRolesRoutes()
    {
        Route::prefix('dashboard')
        ->namespace($this->namespace)
        ->middleware(['web','auth','role:admin'])
        ->group(base_path('routes/web/roles.php'));
    }

    
    protected function mapDashboardPermissionsRoutes()
    {
        Route::prefix('dashboard')
        ->namespace($this->namespace)
        ->middleware(['web','auth','role:admin,manager'])
        ->group(base_path('routes/web/permissions.php'));
    }
}
