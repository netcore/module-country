<?php

namespace Modules\Country\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Country\Models\Country;
use Modules\Country\Observers\CountryObserver;
use Modules\Country\Repositories\CountryRepository;

class CountryServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        Country::observe(CountryObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('country', function () {
            return new CountryRepository;
        });
    }

    /**
     * Register config
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('netcore/module-country.php'),
        ], 'config');
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'country');
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerViews()
    {
        $viewPath = resource_path('views/modules/invoice');
        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath,
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/country';
        }, config('view.paths')), [$sourcePath]), 'country');
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
}
