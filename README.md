# TitanWall
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

#Publish

You can also publish the views, assets, public folder

	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider"

Or using tag

	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="config"
	
#Migration
	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="migrations"
	php artisan migrate
