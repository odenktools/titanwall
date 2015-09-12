# TitanWall
===========
Laravel 5.1 Authentification and membership system

#Install
To install titanwall, add the following lines in your composer.json file:
	
	"require-dev": {
		"ngakost/titanwall": "dev-master"
	}

Save, then run it from your console

	composer update --dev

#Setup
After updating composer, add the service provider to the `providers` array in `config/app.php`

	Ngakost\TitanWall\Providers\TitanWallServiceProvider::class,
	
Also add the aliases to the `aliases` array in `config/app.php`

	'TitanWall' 		=> Ngakost\TitanWall\Facades\TitanWall::class,

#Publish

You can also publish the views, assets, public folder

	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider"

Or using tag

	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="config"
	
#Migration
	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="migrations"
	php artisan migrate

#Note
<<<<<<< HEAD
This is aplha release, please do not install/usage this package for your development

#References
	[https://github.com/Toddish/Verify](https://github.com/Toddish/Verify).
	[https://github.com/parsidev/entrust](https://github.com/parsidev/entrust).
	
=======
This is aplha release, please do not install/usage this package for your development
>>>>>>> 4b41ebdf803004352417495c7016c2d1a63c0860
