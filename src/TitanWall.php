<?php namespace Ngakost\TitanWall;

/**
 * @todo
 *
 * @license MIT
 * @package Ngakost\TitanWall
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
	 * <code>
	 * \TitanWall::can('');
	 * </code>
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
