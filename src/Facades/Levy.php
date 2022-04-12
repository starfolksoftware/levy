<?php

namespace StarfolkSoftware\Levy\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \StarfolkSoftware\Levy\Levy
 */
class Levy extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'levy';
    }
}
