<?php

namespace CampaigningBureau\FacebookRepository;

use CampaigningBureau\FacebookRepository\Repositories\Caching\CachingFacebookRepository;
use CampaigningBureau\FacebookRepository\Repositories\ConcreteFacebookRepository;
use CampaigningBureau\FacebookRepository\Repositories\Contracts\FacebookRepository;
use Illuminate\Support\ServiceProvider;

class FacebookRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // publish config
        $this->publishes([
            __DIR__ . '/config/facebook-repository.php' => config_path('facebook-repository.php'),
        ], 'config');

        $this->loadTranslationsFrom(__DIR__ . '/lang', 'facebook-repository');

        // if caching is enabled, wrap the concrete repository with the caching decorator
        if (config('facebook-repository.caching.enabled')) {
            $this->app->singleton(FacebookRepository::class, function ()
            {
                return new CachingFacebookRepository(new ConcreteFacebookRepository(), $this->app['cache.store']);
            });
        } else {
            $this->app->singleton(FacebookRepository::class, ConcreteFacebookRepository::class);
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/facebook-repository.php', 'facebook-repository');
    }
}