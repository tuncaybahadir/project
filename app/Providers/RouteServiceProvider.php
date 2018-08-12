<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Auth as Auth;
use Redirect as Redirect;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        Route::filter('auth', function () {
            if (Auth::guest()) {
                return Redirect::guest('/');
            }
        });

        Route::filter('auth.basic', function () {
            return Auth::basic();
        });

        Route::filter('admin', function () {
            if (!Auth::guest() && Auth::user()->role > 0) {
            } else {
                return Redirect::to('admin/login');
            }
        });

        Route::filter('guest', function () {
            if (Auth::check()) {
                return Redirect::to('/');
            }
        });
    }

    /**
     * Define the routes for the application.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
