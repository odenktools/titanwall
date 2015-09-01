<?php namespace Ngakost\TitanWall\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Odenktools Core Model
 */
class TitanWallModel extends EloquentModel
{
    /**
     * Table prefix
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Default Odenktools Table
     *
     * @var array|mixed
     */
    protected $tables = array();
	
    /**
     * @var array Make the model's attributes public so behaviors can modify them.
     */
    public $attributes = [];
	
    /**
     * @var array List of attribute names which are json encoded and decoded from the database.
     */
    protected $jsonable = [];
	
    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct();
		
		$this->fill($attributes);

        $defaultDb = \Config::get('database.default');

        if($defaultDb == 'mysql'){

            // Set the prefix
            $this->prefix = \Config::get('titanwall.prefix');

            $this->tables = \Config::get('titanwall.tables');

            $this->tables['user'] = $this->prefix.$this->tables['user'];

            $this->tables['user_fields'] = $this->prefix.$this->tables['user_fields'];

            $this->tables['role'] = $this->prefix.$this->tables['role'];

            $this->tables['role_profile_fields'] = $this->prefix.$this->tables['role_profile_fields'];

            if($this->getTable() != '' ){
                $this->table = $this->prefix.$this->getTable();
            }
        }
    }
}
