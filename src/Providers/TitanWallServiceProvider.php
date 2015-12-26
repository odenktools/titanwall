<?php namespace Ngakost\TitanWall\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;
use Ngakost\TitanWall\Guards\TitanWallGuard;

/**
 * @todo
 * @license MIT
 */
class TitanWallServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
	
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
		$this->publishConfig();
		
		$this->publishMigrations();
		
		$this->app['auth']->extend('titanwall', function ($app)
        {
            // Get the model name from the auth config file
            // file and instantiate a new Hasher and our
            // PasswordUpgrader from the container.
            $model 	= $app->config['auth.model'];
            $hash 	= $app['hash'];

            // Instantiate our own UserProvider class.
            $provider = new TitanWallUserProvider($hash, $model);

            // Return a new Guard instance and pass our
            // UserProvider class into its constructor.
            return new TitanWallGuard($provider, $app['session.store']);
        });
    }

	/**
	 * package config files
	 * php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\OdenktoolsServiceProvider" --tag="config"
	 * @return void
	 */
	private function publishConfig()
	{
        $this->publishes([
		__DIR__ . '/../config/titanwall.php' => config_path('titanwall.php')
        ], 'config');
	}
	
    /**
     * package migration files
	 * 
	 * <code>
	 * php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\OdenktoolsServiceProvider" --tag="migrations"
	 * php artisan migrate
	 * </code>
     * 
     * @return void
     */
    private function publishMigrations()
    {
        $this->publishes([
		    __DIR__. '/../database/migrations' => base_path ('database/migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/seeds/' => base_path('database/seeds')
        ], 'seeds');
        
    }
	
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
		$this->mergeConfigFrom(
			__DIR__.'/../config/titanwall.php', 'titanwall'
		);
		
		$this->registerTitanwall();
		
    }

    public function provides()
    {
        return ['titanwall'];
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerTitanwall()
    {
        $this->app->singleton('titanwall', function ($app) {
            return new \Ngakost\TitanWall\TitanWall($app);
        });

    }
	
}
