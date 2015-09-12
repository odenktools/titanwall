<?php namespace Ngakost\TitanWall\Traits;

/**
 * @todo
 *
 * @license MIT
 * @package Ngakost\TitanWall
 */
use Illuminate\Support\Facades\Config;
use InvalidArgumentException;

trait RoleTrait
{
    /**
     * Many-to-Many relations with Role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('\Ngakost\TitanWall\Models\User', 'odk_user_roles', 'user_id', 'roles_id')
            ->withTimestamps();
    }


    /**
     * Boot the user model
     * Attach event listener to remove the many-to-many records when trying to delete
     * Will NOT delete any records if the user model uses soft deletes.
     *
     * @return void|bool
     */
    public static function boot()
    {
        parent::boot();
    }
}