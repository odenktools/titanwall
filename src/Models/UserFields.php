<?php namespace Ngakost\TitanWall\Models;

/**
 * @todo
 *
 * @license MIT
 */
class UserFields extends TitanWallModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_fields';


    protected $primaryKey = 'id_user_field';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'field_name',
        'field_comment',
        'possible_values',
        'text_select_value',
        'is_mandatory',
        'field_order',
        'sort_values',
        'is_active',
        'show_in_signup',
        'admin_use_only',
        'vertical_layout',
        'is_encrypted',
    ];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        parent::__construct($attributes);
    }
	
	/**
	 * <code>
	 * $fieldtype = \Ngakost\TitanWall\Models\UserFields::find(1)->fieldtype;
	 * echo json_encode($fieldtype);
	 * echo $fieldtype->field_name;
	 * </code>
	 *
     * Get the fieldtype record associated with the userFields.
     */
    public function fieldtype()
    {
        return $this->hasOne('\Ngakost\TitanWall\Models\FieldType', 'id_field_type', 'field_type_id');
    }
	
	/**
	 * <code>
	 * $groupfields = \Ngakost\TitanWall\Models\UserFields::find(1)->groupfields;
	 * echo json_encode($groupfields);
	 * echo $groupfields->group_name;
	 * </code>
	 *
     * Get the groupfields record associated with the userFields.
     */
    public function groupfields()
    {
        return $this->hasOne('\Ngakost\TitanWall\Models\UserGroupFields', 'id_group_field', 'group_field_id');
    }
}
