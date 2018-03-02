<?php

namespace Coderatio\Laranotify;

use Illuminate\Support\ServiceProvider;

class LaranotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'notify');

        $this->publishes([
            __DIR__.'/config/laranotify.php' => config_path('laranotify.php'),
            __DIR__.'/public/animate/animate.css' => public_path('vendor/laranotify/animate/animate.css'),
            __DIR__.'/public/style.css' => public_path('vendor/laranotify/style.css'),
            __DIR__.'/public/icons/icons.css' => public_path('vendor/laranotify/icons/icons.css'),
            __DIR__.'/public/bootstrap-notify/bootstrap-notify.min.js' => public_path('vendor/laranotify/bootstrap-notify/bootstrap-notify.min.js'),
        ], 'laranotify-required');

        $this->publishes([
            __DIR__.'/public/bootstrap/css/bootstrap.min.css' => public_path('vendor/laranotify/bootstrap/css/bootstrap.min.css'),
            __DIR__.'/public/bootstrap/css/bootstrap.min.css.map' => public_path('vendor/laranotify/bootstrap/css/bootstrap.min.css.map'),
            __DIR__.'/public/jquery/jquery-3.3.1.min.js' => public_path('vendor/laranotify/jquery/jquery-3.3.1.min.js'),
        ], 'laranotify-foundations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        include __DIR__ . '/helpers.php';
        include __DIR__ . '/routes/routes.php';

        $this->app->singleton('Notify', function () {
            return new LaranotifyService();
        });

        $this->app->bind('LNConfig', function () {
            return new Configurator();
        });

        $this->app->bind('Laranotify', function () {
            return new LaranotifyService();
        });
    }

    public function provides()
    {
        return array('Notify', 'Laranotify');
    }
}
