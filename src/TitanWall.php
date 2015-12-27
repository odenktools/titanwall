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
	
	/**
	 * Create a new instance of the User model.
	 *
	 * <code>
	 * \TitanWall::getUser()->getRandomString(11);
	 * </code>
	 *
	 * @return \Ngakost\TitanWall\Models\User
	 */
	public function getUser()
	{
		$model = $this->createUserModel(\Config::get('auth.model'));
		
		return $model;
	}
	
	/**
     * Create a new instance of the User model.
     *
     * @param  string  $class
     * @return \Ngakost\TitanWall\Models\User
     */
    protected function createUserModel($class)
    {
        $model = new $class;
        return $model;
    }
}
