<?php

namespace XTrees\CMS;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use XTrees\CMS\Console\Commands\ExampleDataSeed;
use XTrees\CMS\Facades\CMSFacade;
use XTrees\CMS\Http\Middleware\Authenticate;
use XTrees\CMS\Policies\ContentPolicy;

class CMSServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'cms');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cms');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        /** @var Router $router */
        $router = $this->app->make(Router::class);

        $router->aliasMiddleware('cms.auth',Authenticate::class);
        if (config('cms.routes.enable', false)) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        }

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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cms.php', 'cms');

        // Register the service the package provides.
        $this->app->singleton('cms', function ($app) {
            return new CMS;
        });

        $loader = AliasLoader::getInstance();
        $loader->alias('CMS', CMSFacade::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['cms'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/cms.php' => config_path('cms.php'),
        ], 'cms.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/xtrees'),
        ], 'cms.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/xtrees'),
        ], 'cms.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/xtrees'),
        ], 'cms.views');*/

        // Registering package commands.
        $this->commands([
            ExampleDataSeed::class,
        ]);
    }


    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ContentPolicy::class
    ];

    /**
     * Register the application's policies.
     *
     * @return void
     */
    public function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
}
