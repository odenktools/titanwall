<?php namespace Ngakost\TitanWall\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends TitanWallModel
{
	//use SoftDeletes;
	
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role';
	
	protected $dates = ['deleted_at'];

	protected $primaryKey = 'id_role';

	/**
     * The attributes that aren't mass assignable.
	 * 
     * @var array
     */
    protected $guarded = ['amount', 'price'];
	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
		'role_name',
		'role_description',
		'is_active',
		'is_purchaseable',
		'amount',
		'price',
		'time_left',
		'quantity',
		'period',
		'is_builtin',
		'backcolor',
		'forecolor'
	];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

	public function users()
	{
		return $this->belongsToMany('\Ngakost\TitanWall\Models\User', 'odk_user_roles', 'user_id', 'roles_id')
			->withTimestamps();
	}

}