<?php namespace Ngakost\TitanWall\Models;

/**
 * @todo
 *
 * @license MIT
 */
class FieldType extends TitanWallModel
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'field_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['field_name', 'field_description', 'field_size'];

}
