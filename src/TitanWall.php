<?php namespace Ngakost\TitanWall;

/**
 * @todo
 *
 * @license MIT
 * @package Ngakost\TitanWall\Providers
 */
class TitanWall
{
    /**
     * Laravel application
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
	 * @todo
     *
     * @param string $permission
     *
     * @return bool
     */
    public function can($permission)
    {
        //$user = $this->user();

        return 'can';
    }
	
    /**
     * @todo
     *
     */
    public function user()
    {
        return $this->app->auth->user();
    }

}
