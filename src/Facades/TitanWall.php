<?php namespace Ngakost\TitanWall\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @todo
 *
 * @license MIT
 *
 * @package Ngakost\TitanWall\Facades
 */
class TitanWall extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'titanwall';
    }
}
