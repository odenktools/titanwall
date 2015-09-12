<?php namespace Ngakost\TitanWall\Providers;

use Illuminate\Support\ServiceProvider;

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
            $provider = new \Ngakost\TitanWall\Providers\TitanWallUserProvider($hash, $model);

            // Return a new Guard instance and pass our
            // UserProvider class into its constructor.
            return new \Ngakost\TitanWall\Guards\TitanWallGuard($provider, $app['session.store']);
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
	
    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerTitanwall()
    {
        $this->app->bind('titanwall', function ($app) {
            return new TitanWall($app);
        });
    }
	
}
