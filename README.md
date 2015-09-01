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

	Illuminate\Html\HtmlServiceProvider::class,
	Ngakost\TitanWall\Providers\TitanWallServiceProvider::class,

add the Html facade to the `aliases` array in `config/app.php`

	'Html'      => Illuminate\Html\HtmlFacade::class,

#Publish

You can also publish the views, assets, public folder

	php artisan vendor:publish --provider="Odenktools\Cms\Providers\TitanWallServiceProvider"

Or using tag

	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="views"
	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="config"
	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="public"
	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="assets"
	
#Migration
	php artisan vendor:publish --provider="Ngakost\TitanWall\Providers\TitanWallServiceProvider" --tag="migrations"
	php artisan migrate
	
#Test

navigate your browser to http://your-url/blog