<?php

namespace OguzcanDemircan\Presenter;

use Illuminate\Support\ServiceProvider;

class PresenterServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/oguzcandemircan/presenter.php', 'oguzcandemircan.presenter');

        // Register the service the package provides.
        $this->app->singleton('presenter', function ($app) {
            return new Presenter;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['presenter'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/oguzcandemircan/presenter.php' => config_path('oguzcandemircan/presenter.php'),
        ], 'presenter.config');

        // Registering package commands.
        // $this->commands([

        // ]);
    }
}
