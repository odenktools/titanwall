<?php namespace Ngakost\TitanWall\Models;

/**
 * @todo
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

}
