<?php namespace Alegiac\Adsense;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;
use App;


class AdsenseServiceProvider extends LaravelServiceProvider 
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() 
    {
        $this->handleConfigs();
        $this->handleViews();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() 
    {
        App::bind('adsense', function()
        {
            return new \Alegiac\Adsense\AdsBuilder;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {

        return [];
    }

    private function handleConfigs() {

        $configPath = __DIR__ . '/../config/adsense.php';

        $this->publishes([$configPath => config_path('adsense.php')]);

        $this->mergeConfigFrom($configPath, 'packagename');
    }

    private function handleViews() {

        $this->loadViewsFrom(__DIR__.'/../views', 'adsense');
        $this->publishes([__DIR__.'/../views' => base_path('resources/views/alegiac/adsense')]);
    }
}