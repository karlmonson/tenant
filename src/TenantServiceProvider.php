<?php

namespace Karlmonson\Tenant;

use Illuminate\Support\ServiceProvider;

class TenantServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('tenant', function ($app) {
            return new Tenant();
        });
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        if($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\TenantSeed::class,
                Console\Commands\TenantGet::class,
                Console\Commands\TenantSet::class,
                Console\Commands\TenantList::class,
            ]);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['tenant'];
    }
}