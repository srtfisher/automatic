<?php namespace Srtfisher\Automatic\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * Facade for the Automatic Library
 *
 * @package automatic
 */
class AutomaticFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'automatic';
    }
}
