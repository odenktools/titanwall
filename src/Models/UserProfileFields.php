<?php namespace Ngakost\TitanWall\Models;

/**
 * Insert Value (Registration or etc) From Dynamic Fields
 *
 * @license MIT
 */
class UserProfileFields extends TitanWallModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_profile_fields';


    protected $primaryKey = 'id_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'field_value'
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }

    /**
     * @todo
     *
     * <code>
     * $roles = \Odenktools\Coolcms\Models\UserProfileFields::find(1)->users;
     * echo json_encode($roles);
     * </code>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->hasOne('\Ngakost\TitanWall\Models\User', 'id_user', 'user_id');
    }
	
    /**
     * @todo
     *
     * <code>
     * $roles = \Odenktools\Coolcms\Models\UserProfileFields::find(1)->userfields;
     * echo json_encode($roles);
     * </code>
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function userfields()
    {
        return $this->hasOne('\Ngakost\TitanWall\Models\UserFields', 'id_user_field', 'userfield_id');
    }	
}
