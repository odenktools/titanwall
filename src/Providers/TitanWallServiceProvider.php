<?php namespace Ngakost\TitanWall\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * @todo
 */
class TitanWallServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //Load view from
		$this->loadViewsFrom(__DIR__.'/../resources/views', 'titanwall');
		
		//Setup routes for the great package
		if (! $this->app->routesAreCached()) {
			require __DIR__.'/../Http/routes.php';
		}
		
		$this->publishViewFolder();
		$this->publishConfig();
		$this->publishPublicFolder();
		$this->publishAssets();
		$this->publishMigrations();


//		\Auth::extend('titanwall', function($app)
//		{
//			return new \Ngakost\TitanWall\Providers\TitanWallGuard(
//				new \Ngakost\TitanWall\Providers\TitanWallUserProvider(
//					$app['hash'],
//					$app['config']['auth.model']
//				),
//				$app['session.store']
//			);
//
//		});

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
            return new \Ngakost\TitanWall\Providers\TitanWallGuard($provider, $app['session.store']);
        });

    }
	
	/**
	 * package views files
	 * php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\OdenktoolsServiceProvider" --tag="views"
	 * @return void
	 */
	private function publishViewFolder()
	{
		$this->publishes([
		__DIR__ . '/../resources/views' => base_path('resources/views/vendor/titanwall'),
		], 'views');
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
	 * package assets files
	 * php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\OdenktoolsServiceProvider" --tag="public"
	 * @return void
	 */
	private function publishPublicFolder()
	{
		$this->publishes([
		__DIR__. '/../public' => public_path ('vendor/titanwall'),
		], 'public');
	}
	
	/**
	 * package assets files
	 * php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\OdenktoolsServiceProvider" --tag="assets"
	 * @return void
	 */
	private function publishAssets()
	{
        $this->publishes([
		__DIR__. '/../resources/assets' => base_path ('resources/assets/vendor/titanwall'),
        ], 'assets');
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
    }
	
    /**
     * Get the services provided by the provider.
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
