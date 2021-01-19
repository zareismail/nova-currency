<?php

namespace Zareismail\NovaCurrency;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Console\Events\ArtisanStarting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Nova as LaravelNova; 
use Laravel\Nova\Events\ServingNova;

class NovaCurrencyServiceProvider extends ServiceProvider implements DeferrableProvider
{  
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        $this->app->runningInConsole() ? $this->artisanStarting() : $this->servingNova();
    }

    /**
     * Register any Nova services.
     * 
     * @return void
     */
    public function servingNova()
    {
        LaravelNova::resources([
            Nova\Currency::class,
            Nova\DefaultCurrency::class,
        ]);

        Gate::policy(Models\NovaCurrency::class, Policies\Currency::class);

        if($currency = Nova\DefaultCurrency::option('currency')) {
            \Config::set('nova.currency', $currency);
        }
        
    }

    /**
     * Register any Artisan services.
     * 
     * @return void
     */
    public function artisanStarting()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Get the events that trigger this service provider to register.
     *
     * @return array
     */
    public function when()
    {
        return [
            ServingNova::class,
            ArtisanStarting::class,
        ];
    }
}
